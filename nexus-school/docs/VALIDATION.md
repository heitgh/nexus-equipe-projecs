# Validação — estado real

- TypeScript: passou.
- ESLint: passou, sem erros; aviso de exportação corrigido posteriormente.
- Vitest: 5 testes passaram.
- Build Next.js local: passou.
- Build Vercel: passou; deployment READY.
- RLS: 13 cenários passaram no banco remoto, usando fixtures transacionais com rollback.
- RLS ativada nas 20 tabelas públicas.
- Supabase Security Advisor: um aviso informativo intencional em login_limits (tabela fechada, sem políticas para usuários).
- Navegador remoto: página inicial renderizou; catálogo retornou 12 ofertas do banco; interação com a busca atingiu timeout e não foi considerada aprovada. Filtro por Minicurso retornou 2 ofertas e troca para tema escuro foi confirmada no navegador. Tela de login renderizada.
- Logs capturados mostraram erros da extensão e da página de login Vercel anterior, não erros atribuídos à aplicação na home inspecionada.
- Suíte Playwright criada para desktop/mobile; execução automatizada completa ainda não realizada.
- Lighthouse: não executado; nenhuma pontuação alegada.
- Envio e recebimento de e-mail, recuperação completa, links expirados: pendentes de SMTP/redirects e teste com destinatário autorizado.

O projeto permanece em implementação. Não satisfaz ainda todos os critérios de conclusão do PROJECT_BRIEF.

## API de autenticação

- Login por e-mail: director, admin, teacher, student e guardian passaram.
- Login por RA: passou após correção da consulta interna.
- Senha incorreta no RA: recusada.
- Aluno tentando criar administrador: bloqueado (403).
- RPC de resolução de e-mail por RA para visitante: bloqueada.
- Evidência resumida: tests/integration/api-results.json. Nenhum token está incluído nesse arquivo.
