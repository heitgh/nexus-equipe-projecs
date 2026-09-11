alter table public.courses add column slug text not null default gen_random_uuid()::text unique;
alter table public.courses add column area text not null default 'Formação';
alter table public.courses add column topics jsonb not null default '[]';
alter table public.profiles add column requested_course text;
alter table public.profiles add column scholarship boolean not null default false;
create or replace function private.on_signup() returns trigger language plpgsql security definer set search_path='' as $$begin insert into public.profiles(id,name,requested_course,scholarship) values(new.id,left(coalesce(nullif(new.raw_user_meta_data->>'name',''),'Estudante Nexus'),120),left(new.raw_user_meta_data->>'course',150),coalesce(new.raw_user_meta_data->>'scholarship','false')='true');return new;end$$;
