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
| Pré-condição | O sistema deve estar disponível e o usuário deve possuir uma conta registrada |
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

# RF02 - Cadastrar Usuário

#### Autor: @brenoborgesbr - Breno Borges.

- - -
#### Revisor : @uGonzaguinha - Gustavo Gonzaga dos Santos.

| Item            | Descrição                                                              |
| --------------- | ---------------------------------------------------------------------- |
| Caso de uso     | RF02 - Efetuar Cadastro de Usuário.                                    |
| Resumo          | Este caso de uso descreve o processo pelo qual um usuário não registrado pode criar uma conta no site de agendamento de consulta, fornecendo as informações necessárias.|
| Ator principal  | Usuário não registrado                                                                                                        |
| Pré-condição| O usuário acessa a página inicial do site e  usuário seleciona a opção de registro de conta.|
|Pós-condições| O usuário acessa a página inicial do site e  usuário preenche as informações de registro de conta.      |
                                
## Descrição Sucinta:
Realiza o cadastramento dos usuários na plataforma
						
#### Fluxo principal:
1. o usuario ao abrir o link do site é encaminhado a pagina de login.
2. Nesse momento é exibido um botão com título “Cadastre-se” que redireciona o usuário à tela de Cadastro.
3. A aplicação dispõe ao autor um formulário para ser preenchido com seus respectivos dados.
4. Ao preencher os campos o autor confirma os dados no botão de “criar conta”.
5. Em seguida o ator passa para um processo de verificação a fim de confirmar sua conta recém criada.

                                
#### Fluxo alternativo:
 FA01 - Se o sistema detectar que as informações fornecidas são inválidas ou já existem em outra conta, ele notificará o usuário e solicitará que ele corrija os campos relevantes. 



#### Campos do formulário.

| Campo    | Obrigatório? | Editável? | Formato      |
| -------- | ------------ | --------- | ------------ |
| Nome     | Sim          | Sim       | Texto        |
| Email    | Sim          | Sim       | Texto        |
| Senha    | Sim          | Sim       | Texto        |
| CPF      | Sim          | Sim       | Alfanumérico |
| Endereço | Não          | Sim       | Texto        |
| Contato  | Sim          | Sim       | Numérico     |
| Gênero   | Sim          | Sim       | Checkbox     |


# RF03 - Agendar Consulta 

#### Autor: @Hatilancaio - Hatilan Caio Alves Fontes.
- - -
#### Revisor : @Brenoborgesbr - Breno Borges

| Item | Descrição |
| ---  | --- |
| Caso de Uso | Agendar Conculta |
| Resumo |  Ao acessar a página de agendamento, o usuário deve ser capaz de realizar as seguintes ações: agendar uma nova consulta, editar consultas existentes |
| Ator primário |  Usuário |
| Atores secundários |  Não possui |
| Pré-condição | O sistema deve estar disponível e deve possuir uma conta registrada |
| Pós-condições |  Após realizar o agendamento de uma consulta, o usuário é redirecionado para a página inicial do sistema. Se ocorrer algum erro durante o agendamento, o usuário permanece na página de agendamento com uma mensagem de erro. |

## Descrição sucinta:
Permite que os usuários agendem uma nova consulta no sistema.

## Fluxo Principal:
1. O usuário acessa a interface do sistema e seleciona a opção 
"Agendar Consulta".
2. O sistema apresenta a tela LOGIN E SENHA solicitando os mesmos, após a confirmação da acessibilidade o acesso é liberado pelo sistema.
3. O usuário peenche os campos do foemulário, incluindo:
    - Nome do Paciente
    - Data da Consulta
    - Hora da Consulta
4. O usuário confirma o agendamento da consulta.
5. O sistema registra os dados da nova consulta e exibe uma mensagem de confirmação de sucesso.
6. O usuário é direcionado de volta à tela inicial do sistema.

## Campos do Formulário:
| Campo | Obrigatório? | Editável? | Formato |
| --- | --- | --- | --- |
| Nome do Paciente | Sim | Sim | Texto |
| Data da Consulta | Sim | Sim | Date(dd/mm/aaaa) |
| Hora da Consulta | Sim | Sim | Time(hh:mm) |

## Fluxos Alternativos:
FA01 - **Verificar Disponibilidade de Horários:**
1. Antes de preencher os campos do formulário, o usuário opta por verificar a disponibilidade de horários.
2. O sistema exibe um calendário com os horários disponíveis para agendamento.
3. O usuário seleciona uma data e horário disponível e prossegue com os preenchimento do formulário.
4. O fluxo principal continua a partir do preenchimento do formulário.

FA02 - **Editar Consulta:**
1. O usuário acessa a tela inicial do sistema e seleciona a opção "Editar Consulta".
2. O sistema exibe uma lista das consultas agendadas pelo usuário.
3. O usuário seleciona a consulta que deseja editar.
4. O sistema permite que o usuário edite as informações da consulta, como nome do paciente, dara e hora.
5. O usuário confirma as alterações.
6. O sistema atualiza os dados da consulta e exibe uma confirmação.

## Exceções:
| Código | Descrição |
| --- | --- |
| E1 | Campos obrigatórios não preenchidos |
| - | O sistema exibe uma mensagem de erro informando que todos os campos obrigatórios devem ser preenchidos corretamente para prosseguir com o agendamento da consulta. |
| E2 | Data e/ou hora inválidas |
| - | O sistema exibe uma mensagem de erro informando que a data e/ou hora da consulta fornecidas são inválidas. Solicita ao usuário selecionar uma data e hora válidas para a consulta. |
| E3 | Erro no processamento do agendamento |
| - | O sistema exibe uma mensagem de erro informando que ocorreu um erro no processamento do agendamento da consulta. Solicita ao usuário tentar novamente mais tarde ou entrar em contato com o suporte técnico. |

## Opções dos Usuários:
| Opção | Descrição | Atalho |
| --- | --- | --- |
| Confirmar | Confirma o agendamento da consulta | Enter |
| Continuar(FA) | Usado no fluxo alternativo para confirmar a escolha do horário disponível | Enter |
| Editar | Edita os detalhes de uma consulta agendada | - |



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
| -      | 1. O sistema avisa o usuário que não há consultas agendadas |
| -      | 2. O sistema pergunta se o usuário deseja agendar uma nova consulta |
| -      | 3. Se sim, o usuário é redirecionado à página de agendamento |

# RF_06 - configuração de roteamento e criação de tabelas do sistema

#### Autor: @gabrielbdsm - Gabriel barbosa dos santos martiliano

- - -
#### Revisor : @Hatilancaio - Hátilan

| Item | Descrição |
| ---  | --- |
| Caso de Uso | configuração de roteamento e criação de tabelas do sistema |
| Resumo |  Esta requisição detalha a configuração das rotas e do banco de dados para a aplicação de consultas médicas, abrangendo funcionalidades como login, cadastro de usuários, marcação, edição e exclusão de consultas, criação de consultas por usuários e secretárias, e criação de agendas para secretárias.  |
| Ator primário |  Desenvolvedor |
| Atores secundários |  Não possui |
| Pré-condição | O sistema deve estar instalado e configurado para utilizar o Composer.O arquivo configuração deve estar configurado corretamente com as informações de conexão com o banco de dados.Mysql deve está configurado corretamente.|
| Pós-condições |  O banco de dados está configurado e possui as tabelas necessárias para armazenar informações de usuários, consultas e agendas.O sistema de rotas estão configuradas corretamente.
|


## Descrição Sucinta:
Esta requisição define as etapas para configurar as rotas e o banco de dados da aplicação de consultas médicas. O desenvolvedor deve adicionar as rotas necessárias para funcionalidades como login, cadastro de usuários, marcação, edição e exclusão de consultas, criação de consultas por usuários e secretárias, e criação de agendas para secretárias. As informações de conexão com o banco de dados devem ser configuradas no arquivo .env, e as tabelas já estão criadas para armazenar dados de usuários, consultas e agendas..


## Fluxo principal:

1. O desenvolvedor identifica as funcionalidades que precisam de rotas e decide os caminhos para essas funcionalidades.
2. O desenvolvedor cria as rotas no arquivo de configuração de rotas da aplicação, como o arquivo router.php.
3. Para cada rota criada, o desenvolvedor especifica qual método do controlador deve ser chamado quando a rota é acessada
4. O desenvolvedor configura as informações de conexão com o banco de dados no arquivo de configuração.

## Fluxos Alternativos:
N/A

## Exceções:
| Código | Descrição                                        |
|--------|--------------------------------------------------|
|    |           |

## Campos do Formulário:
| Campo | Obrigatório? | Editável? | Formato |
| --- | --- | --- | --- |

## Opções dos Usuários:
| Item | Descrição | Atalho |
| --- | --- | --- |

# RF_07 - Realizar cadastro de horário

#### Autor: @gabrielbdsm - Gabriel barbosa dos santos martiliano

- - -
#### Revisor : @Hatilancaio - Hátilan

| Item | Descrição |
| ---  | --- |
| Caso de Uso | Cadastro de horário |
| Resumo | Esta requisição define as etapas para que a secretária possa cadastrar novos horários na aplicação. O desenvolvedor deve criar as funcionalidades necessárias para permitir o cadastro de horários pela secretária  |
| Ator primário |  Secretária |
| Atores secundários |  Não possui |
| Pré-condição | O sistema deve estar configurado corretamente e a secretária deve ter acesso à funcionalidade de cadastro de horário.|
| Pós-condições | O horário é cadastrado com sucesso no sistema, ou uma mensagem de erro é exibida caso ocorra algum problema.|

## Descrição Sucinta:
Esta requisição define as etapas para que a secretária possa cadastrar novos horários na aplicação. O desenvolvedor deve criar as funcionalidades necessárias para permitir o cadastro de horários pela secretária.

## Fluxo principal:

1. A secretária acessa a página de agenda.
2. O sistema exibe o formulário de cadastro de horário.
3. A secretária preenche os campos do formulário, incluindo a data e a hora.
4.  secretária envia o formulário de cadastro.
5. O sistema valida os dados recebidos.
6. O sistema verifica se já existe um horário cadastrado para a mesma data e hora.
7. Se já existir um horário cadastrado para a mesma data e hora, o sistema exibe uma mensagem de erro informando que não é possível cadastrar o horário.
8. Se não existir um horário cadastrado para a mesma data e hora, o sistema salva o novo horário no banco de dados.
9. O sistema exibe uma mensagem de sucesso informando que o horário foi cadastrado com sucesso.

## Fluxos Alternativos:
N/A

## Exceções:
| Código | Descrição                                        |
|--------|--------------------------------------------------|
|1| Já existe um horário cadastrado para a data e hora especificadas.           |

## Campos do Formulário:
| Campo | Obrigatório? | Editável? | Formato |
| --- | --- | --- |--- |
| Data | Sim | Sim | data |
| Hora | Sim | Sim | hora |



## Opções dos Usuários:
| Item | Descrição | Atalho |
| --- | --- | --- |

# RF_08 - Mostrar horários da agenda

#### Autor: @gabrielbdsm - Gabriel barbosa dos santos martiliano

- - -
#### Revisor : @Hatilancaio - Hátilan

| Item | Descrição |
| ---  | --- |
| Caso de Uso | Mostrar horários da agenda |
| Resumo | 	Esta requisição detalha as etapas para exibir os horários cadastrados na agenda. A funcionalidade permite que a secretária visualize os horários disponíveis. |
| Ator primário |  Secretária |
| Atores secundários |  Não possui |
| Pré-condição | O sistema deve estar configurado corretamente e a secretária deve ter acesso à funcionalidade de visualização dos horários.|
| Pós-condições |A secretária visualiza os horários disponíveis na agenda.|

## Descrição Sucinta:
Esta requisição define as etapas para que a secretária possa visualizar os horários cadastrados na agenda da aplicação. O desenvolvedor deve implementar as funcionalidades necessárias para exibir esses horários de forma clara e organizada.

## Fluxo principal:

1. A secretária acessa a página de horário.
2. O sistema exibe os horário cadastrado.


## Fluxos Alternativos:
N/A

## Exceções:
| Código | Descrição                                        |
|--------|--------------------------------------------------|
      
## Campos do Formulário:
| Campo | Obrigatório? | Editável? | Formato |
| --- | --- | --- |--- |

## Opções dos Usuários:
| Item | Descrição | Atalho |
| --- | --- | --- |
