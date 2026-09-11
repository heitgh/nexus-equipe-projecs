# Segurança

- Somente dados fictícios neste ambiente.
- RLS habilitada nas 20 tabelas públicas; acesso negado por padrão.
- Professor limitado às turmas atribuídas; responsável limitado aos vínculos cadastrados pela gestão.
- Signup sempre cria student/pending, ignorando papéis enviados no metadata.
- Funcionário admin não altera gestores ou diretor; somente director pode criar outro admin pela função de contas.
- Limite persistente de tentativas por hash do RA. Não se expõe o e-mail no navegador.
- Sessões verificadas no servidor com getUser. Suspensão é consultada nas políticas atuais do banco.
- .env, senhas e tokens não são versionados. Chave publishable é pública por desenho.
- Arquivos legados PHP não foram recebidos neste ambiente nem reutilizados; qualquer segredo legado deve ser rotacionado pelo proprietário.
- A tabela login_limits tem RLS sem políticas intencionalmente, com privilégios revogados para anon/authenticated; apenas o serviço a usa.
- Logs de auditoria são somente leitura para director; mutações de usuários comuns não podem apagar evidências.

Antes de dados reais: configurar SMTP/redirects, definir retenção, remover fixtures, auditar acessos administrativos, revisar textos legais com contexto real e concluir testes E2E. Não há declaração de conformidade jurídica completa.
