# Pandemia 
Aplicação desenvolvida utilizando  PHP 7.4.19, CodeIgniter v4.1.2 e MySQL 8.0.25. Para configuração do ambiente foi utilizando o XAMPP.

## Configuração do projeto

- Para instalar as dependências, utilize composer, executando o comando `composer require codeigniter4/framework --prefer-source`
## Configuração do Banco de Dados

- database: pandemia
- username: root
- password: admin
- porta: 3305
- Possui uma tabela que contém as solicitações salvas. Abaixo o código para criação da mesma:
<pre><code>CREATE TABLE SOLIC(
  ID INT NOT NULL AUTO_INCREMENT,
  NOME VARCHAR(100) NOT NULL,
  CPF CHAR(11) NOT NULL,
  DATASOLIC DATETIME DEFAULT CURRENT_TIMESTAMP,
  DATAENTREG DATE NOT NULL,
  DATACONTAM DATE,
  DATAMELHORA DATE,
  STATUS VARCHAR(12) DEFAULT 'PENDENTE',
  TIPO VARCHAR(10) NOT NULL,
  PRIMARY KEY (ID)
);</code></pre>


## Utilização

- Para cadastrar uma nova solicitação basta clicar no botão 'Nova Solicitação', preencher o formulário e salvar
- Para acessar as solicitações de um determinado usuário, basta clicar no botão 'Solicitações' e informar o CPF dele. Na página de solicitações é possível também marcar uma determinada solicitação como 'cancelada' ou 'concluída', utilizando a coluna de ações
- Para visualizar relatórios de solicitações feitas, basta clicar no botão 'Relatórios' e selecionar o que deseja ser visto
