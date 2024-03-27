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

