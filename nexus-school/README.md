# Nexus School

Site institucional e portal acadêmico demonstrativo da Nexus Inc.

## Executar

Requer Node.js 24 e npm. Copie `.env.example` para `.env.local`, preencha o projeto Supabase e execute:

```bash
npm ci
npm run dev
```

## Qualidade

```bash
npm run lint
npm run typecheck
npm test
npm run build
```

O teste `tests/integration/rls.sql` deve ser executado apenas em ambiente de teste. Ele cria fixtures dentro de uma transação e as descarta com rollback.

## Implementado

- Site institucional, catálogo conectado ao banco, páginas de curso, blog/mural, FAQ, bolsas e contato.
- Temas claro/escuro, navegação responsiva e movimento reduzido.
- Login por e-mail e RA; solicitação de cadastro; telas de recuperação e redefinição.
- Gestão de pessoas, cursos, turmas, matrículas, atribuição de professores e responsáveis.
- Disciplinas, notas, frequência, horários, materiais, atividades e entregas.
- Comunicados, calendário, solicitações com resposta, documentos demonstrativos e auditoria.
- Supabase Auth, RLS em 20 tabelas e Edge Function de contas.

## Limitações que impedem considerar o projeto concluído

- Criação do repositório remoto não está disponível no conector; código ainda não sincronizado com `heitgh/nexus-school`.
- SMTP, Site URL, URLs de retorno e entrega de e-mail precisam ser configurados e testados. As contas de teste usam endereços `.invalid` e não recebem mensagens.
- O primeiro deploy foi solicitado como preview, mas a Vercel o classificou como produção. Ver `docs/DEPLOYMENT.md`.
- Ainda não há medição Lighthouse, cobertura E2E completa, uploads privados, notificações persistentes ou mensagens diretas.
- Gestão administrativa possui dois níveis: admin e director. Permissões por funcionário mais granulares permanecem no roadmap.
- Documentos são impressões demonstrativas, sem validade acadêmica. Não existem cobranças reais.
- Paginação é limitada a 200 registros por módulo, sem pesquisa no portal nesta versão.

Consulte `PROJECT_BRIEF.md`, `ARCHITECTURE.md`, `SECURITY.md`, `ROADMAP.md` e `docs/VALIDATION.md`.
