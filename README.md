# Eng_Soft-Grupo1
Trabalho da disciplina de Engenharia de Software da turma de 2024.1



# RF_01 - Realizar Login do Usuário

#### Autor: @gabrielbdsm - Gabriel barbosa dos santos martiliano

- - -
#### Revisor : @CaesarCrew - João Pedro

| Item | Descrição |
| ---  | --- |
| Caso de Uso | Login |
| Resumo |  Ao acessar a página de login, o usuário deve ser capaz de realizar as seguintes ações: efetuar o login na aplicação, acessar a tela de cadastro (se for a primeira vez) e ter a opção de ir para a tela de redefinição de senha. |
| Ator primário |  Usuário |
| Atores secundários |  Não possui |
| Pré-condição | O sistema deve estar disponível e deve possuir uma conta registrada |
| Pós-condições |  Se autenticado com sucesso, o usuário é redirecionado para a página inicial do sistema, caso contrario o usuário permanece na página de login com uma mensagem de erro. |

## Descrição Sucinta:
Realiza o login dos usuários na plataforma

## Fluxo principal:
1. O usuário acessa a página de login e insere seu nome de usuário ou e-mail e senha.
2. O sistema verifica as credenciais do usuário.
3. Se as credenciais forem válidas, o sistema autentica o usuário e o redireciona para a página inicial.

## Fluxos Alternativos:

#### FA01 - Cadastrar:
1. Entra na pagina de login
2. Usuário seleciona a opção 'Cadastrar'
3. Usuário é redirecionado para a tela de cadastro

#### FA02 - Redefinição de senha:
1. Entra na pagina de login
2. Usuário seleciona a opção 'Redefinição de senha'
3. Usuário é redirecionado para a tela de redefinição de senha

## Exceções:
| Código | Descrição                                        |
|--------|--------------------------------------------------|
| E1     | Usuário e/ou Credenciais inválidos                              |
| -      | 1. O sistema exibe uma mensagem de erro informando que o usuário e/ou Credenciais estão incorreto. |


## Campos do Formulário:
| Campo | Obrigatório? | Editável? | Formato |
| --- | --- | --- | --- |
| e-mail ou nome de usuário | Sim | Sim | Texto |
| Senha | Sim | Sim | alfanumérico |



## Opções dos Usuários:
| Item | Descrição | Atalho |
| --- | --- | --- |
| Logar | Verificar se o usuário esta cadastrado no nosso sistema | - |
| Cadastrar | Redirecionar o usuário para a tela de cadastro | - |
| Redefinir senha | Redirecionar o usuário para a tela de Redefinir senha | - |


# RF_04 - Cancelar Consulta

#### Autor: @uGonzaguinha - Gustavo Gonzaga dos Santos.
- - -
#### Revisor : @gabrielbdsm - Gabriel barbosa dos santos martiliano

| Item | Descrição |
| ---  | --- |
| Caso de Uso | Cancelar Consulta |
| Resumo |  Permite que os usuários cancelem uma consulta que foi previamente agendada. |
| Ator primário |  Usuário |
| Atores secundários |  Não possui |
| Pré-condição | O usuário deve estar autenticado no sistema para acessar este recurso. |
| Pós-condições |  O sistema registra o cancelamento, atualiza os dados da consulta e exibe uma mensagem de confirmação. |

## Descrição Sucinta:
Realiza o cancelamento de consultas agendadas pelos usuários.

## Fluxo principal:
1. O ator acessa a tela inicial do sistema e seleciona a opção "Cancelar Consulta";
2. O sistema apresenta a tela LOGIN E SENHA solicitando os mesmos, após a verificação das credenciais, o acesso é liberado pelo sistema para cancelamento;
3. O sistema exibe na tela o formulário de cancelamento de consulta contendo:
   - Nome do Paciente
   - Data da Consulta
   - Hora da Consulta
4. O usuário preenche os campos obrigatórios corretamente.
5. O usuário confirma o cancelamento da consulta.
6. O sistema registra o cancelamento, atualiza os dados da consulta e exibe uma mensagem de confirmação.

## Fluxos Alternativos:

N/A

## Exceções:
| Código | Descrição                                        |
|--------|--------------------------------------------------|
| E1     | Campos obrigatórios não preenchidos                              |
| -      | O sistema exibe uma mensagem de erro informando que todos os campos obrigatórios devem ser preenchidos corretamente para prosseguir com o cancelamento da consulta. |
| E2     | Data e/ou hora inválidas                              |
| -      | O sistema exibe uma mensagem de erro informando que a data e/ou hora da consulta fornecidas são inválidas. Solicita ao usuário selecionar uma data e hora válidas para cancelar. |


## Campos do Formulário:
| Campo | Obrigatório? | Editável? | Formato |
| --- | --- | --- | --- |
| Nome do Paciente | Sim | Sim | Texto |
| Data da Consulta | Sim | Sim | Date |
| Hora da Consulta | Sim | Sim | Time |



## Opções dos Usuários:
| Item | Descrição | Atalho |
| --- | --- | --- |
| Confirmar | Confirma o cancelamento da consulta | Enter |
| Cancelar  | Cancela o cancelamento da consulta | - |

# Eng_Soft-Grupo1
Trabalho da disciplina de Engenharia de Software da turma de 2024.1

# RF_05 - Listar consultas

#### Autor: @CaesarCrew - João Pedro

- - -
#### Revisor: @Hatilancaio - Hátilan

| Item | Descrição |
| --- | --- |
| Caso de uso | Listar consulta |
| Resumo | O usuário precisa ser capaz de visualizar as consultas agendadas em seu nome  |
| Ator primários | Usuário |
| Atores secundários | Não possui |
| Pré-condições | O usuário deve estar logado no sistema |
| Pós-condições | Se houver consultas registradas no sistema,  o usuário é redirecionado para a lista de consultas agendadas|

## Descrição Sucinta:
Exibe a lista das consultas agendadas pelo usuário

## Fluxo Principal:
1. De qualquer página, o usuário usará do menu de navegação, selecionando a opção "Meus agendamentos"
2. O sistema redireciona o usuário para a página de agendamentos

## Fluxos Alternativos

#### FA01 - Acesso pelo perfil
1. O cliente clicará no ícone de perfil
2. O sistema exibe a página de perfil
3. O cliente usa o menu de navegação interno da seção perfil
na esquerda e clica na opção "Meus agendamentos"
4. O sistema imprime na tela as próximas consultas do cliente

## Exceções:
| Código | Descrição                                        |
|--------|--------------------------------------------------|
| E1     | O cliente não efetuou login |
| -      | 1. O sistema exibe uma mensagem de erro, informando ao usuário que é necessário estar logado para efetuar essa operação |
| E2     | O cliente não possui consultas agendadas |
| -      | 1. O sistema avisa o usuário que não há consultas agendadas
2. O sistema pergunta se o usuário deseja agendar uma nova consulta
3. Se sim, o usuário é redirecionado à página de agendamento|
