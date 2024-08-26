# Ponderada: Atividade: Elaboração de aplicação web integrada a um banco de dados

## OBS: Professor, pedi ajuda ao **ChatGPT** para construir esse readme.

Este repositório contém o código de um aplicativo web simples desenvolvido em PHP, que se conecta a um banco de dados MySQL hospedado na AWS (Amazon RDS) e roda em uma instância EC2. A aplicação permite a gestão de projetos, permitindo criar e listar registros de projetos.

## Conteúdo

- `html/SamplePage.php`: Código principal da aplicação PHP.
- `inc/dbinfo.inc`: Arquivo de configuração com as credenciais do banco de dados.
- `README.md`: Este arquivo com detalhes do repositório.

## Estrutura do Banco de Dados

### Tabela `PROJECTS`
- `ID`: Inteiro, chave primária, auto-incremento.
- `PROJECT_NAME`: Nome do projeto (VARCHAR).
- `START_DATE`: Data de início do projeto (DATE).
- `BUDGET`: Orçamento do projeto (DECIMAL).
- `DESCRIPTION`: Descrição do projeto (TEXT).

## Deploy na AWS

- O servidor web e o código PHP foram hospedados em uma instância EC2.
- O banco de dados MySQL foi criado em uma instância RDS.
- O deploy foi realizado utilizando o ambiente LAMP (Linux, Apache, MySQL, PHP) na EC2.

## Vídeo de Demonstração

Para assistir ao vídeo demonstrando as máquinas/serviços em execução no console da AWS e a descrição do deploy, clique no link abaixo:

[Assista ao vídeo](https://youtu.be/aT9dbE7lJcA)

