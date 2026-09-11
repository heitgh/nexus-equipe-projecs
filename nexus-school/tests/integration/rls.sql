begin;
insert into auth.users(id,raw_user_meta_data) values
('10000000-0000-4000-8000-000000000001','{"name":"Teste Aluno A"}'),
('10000000-0000-4000-8000-000000000002','{"name":"Teste Aluno B"}'),
('10000000-0000-4000-8000-000000000003','{"name":"Teste Responsável"}'),
('10000000-0000-4000-8000-000000000004','{"name":"Teste Professor"}'),
('10000000-0000-4000-8000-000000000005','{"name":"Teste Gestão"}'),
('10000000-0000-4000-8000-000000000006','{"name":"Teste Madeira"}'),
('10000000-0000-4000-8000-000000000007','{"name":"Teste Pendente","role":"director","status":"approved"}');
update public.profiles set status='approved' where id::text like '10000000-%' and id<>'10000000-0000-4000-8000-000000000007';
update public.profiles set role='guardian' where id='10000000-0000-4000-8000-000000000003';
update public.profiles set role='teacher' where id='10000000-0000-4000-8000-000000000004';
update public.profiles set role='admin' where id='10000000-0000-4000-8000-000000000005';
update public.profiles set role='director' where id='10000000-0000-4000-8000-000000000006';
insert into public.courses(id,title,category,duration,published) values('20000000-0000-4000-8000-000000000001','Teste Curso','Técnico','18 meses',false);
insert into public.classes(id,title,course_id,period) values('30000000-0000-4000-8000-000000000001','Teste Turma A','20000000-0000-4000-8000-000000000001','Manhã'),('30000000-0000-4000-8000-000000000002','Teste Turma B','20000000-0000-4000-8000-000000000001','Noite');
insert into public.enrollments(student_id,class_id) values('10000000-0000-4000-8000-000000000001','30000000-0000-4000-8000-000000000001'),('10000000-0000-4000-8000-000000000002','30000000-0000-4000-8000-000000000002');
insert into public.guardian_students(guardian_id,student_id) values('10000000-0000-4000-8000-000000000003','10000000-0000-4000-8000-000000000001');
insert into public.class_teachers(teacher_id,class_id) values('10000000-0000-4000-8000-000000000004','30000000-0000-4000-8000-000000000001');
insert into public.grades(student_id,class_id,subject,title,score) values('10000000-0000-4000-8000-000000000001','30000000-0000-4000-8000-000000000001','Teste','Teste A',8),('10000000-0000-4000-8000-000000000002','30000000-0000-4000-8000-000000000002','Teste','Teste B',9);
create function pg_temp.assert_true(ok boolean,label text) returns void language plpgsql as $$begin if ok is not true then raise exception 'FAIL: %',label;end if;end$$;
set local role authenticated;
select set_config('request.jwt.claim.sub','10000000-0000-4000-8000-000000000001',true);
select pg_temp.assert_true((select count(*)=1 from public.grades where title like 'Teste %'),'aluno só vê própria nota');
select pg_temp.assert_true((select count(*)=0 from public.profiles where id='10000000-0000-4000-8000-000000000002'),'aluno não vê outro aluno');
with changed as(update public.profiles set role='director' where id='10000000-0000-4000-8000-000000000001' returning id) select pg_temp.assert_true((select count(*)=0 from changed),'aluno não se promove');
select set_config('request.jwt.claim.sub','10000000-0000-4000-8000-000000000003',true);
select pg_temp.assert_true((select count(*)=1 from public.grades where title like 'Teste %'),'responsável só vê vinculado');
select set_config('request.jwt.claim.sub','10000000-0000-4000-8000-000000000004',true);
select pg_temp.assert_true((select count(*)=1 from public.classes where title like 'Teste Turma%'),'professor só vê turma atribuída');
with changed as(update public.grades set score=10 where title='Teste B' returning id) select pg_temp.assert_true((select count(*)=0 from changed),'professor não altera outra turma');
with changed as(update public.grades set score=7 where title='Teste A' returning id) select pg_temp.assert_true((select count(*)=1 from changed),'professor altera própria turma');
select set_config('request.jwt.claim.sub','10000000-0000-4000-8000-000000000007',true);
select pg_temp.assert_true((select role='student' and status='pending' from public.profiles where id='10000000-0000-4000-8000-000000000007'),'metadata não eleva privilégio');
select pg_temp.assert_true((select count(*)=0 from public.grades where title like 'Teste %'),'pendente não acessa acadêmico');
select set_config('request.jwt.claim.sub','10000000-0000-4000-8000-000000000005',true);
select pg_temp.assert_true((select count(*)=2 from public.grades where title like 'Teste %'),'gestão acessa notas');
select pg_temp.assert_true((select count(*)=0 from public.audit_logs),'gestão não acessa auditoria da direção');
select set_config('request.jwt.claim.sub','10000000-0000-4000-8000-000000000006',true);
select pg_temp.assert_true((select count(*)>0 from public.audit_logs),'direção acessa auditoria');
set local role anon;
select pg_temp.assert_true((select count(*)=0 from public.courses where title='Teste Curso'),'visitante não acessa rascunho');
reset role;
select '13 cenários RLS aprovados; fixtures descartadas por rollback' as result;
rollback;
