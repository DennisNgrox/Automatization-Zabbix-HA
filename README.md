<h1 align="center"> Zabbix High Availability - Ansible </h1>

<div align="center">

![text-x-script-icon](https://cdn.iconscout.com/icon/free/png-256/free-ansible-282283.png)


 <h1>

</div>


<b>Este repositório foi criado para salvar e atualizar a automação em Ansible da criação de um ambiente Zabbix em Alta Disponibilidade</b>



[Scripts]

    - Tarefas automatizadas
    - Código em Yaml
    
[Observação]
 
    - Necessário 6 Máquinas Virtuais:
       - zabbix-front_end
       - zabbix-server_node1
       - zabbix-server_node2
       - DB_MySQL_node1
       - DB_MySQL_node2
       - Máquina responsável por executar o playbook
 
  [infraestrutura]
 
      - Zabbix-Front_end 6.0
      - Zabbix-Server-node1 6.0
      - Zabbix-Server-node2 6.0
      - DB_MySQL_node1 8.0
      - DB_MySQL_node2 8.0
    
      - Sistema Operacional utilizado: CentOS 8


  
  
![text-x-script-icon](https://i.ibb.co/0KJLTQL/image-git.png)

 <h1></h1>

[Explicação do funcionamento do ambiente]
    
     - O Zabbix contém 2 nodes, um no estado "active" e outro no estado "standby",
       o node em "standby" realiza checagens no node "active" para validar se o mesmo está UP, 
       caso o node "active" fique down, o node em "standby" se torna o node "active" e torna o node down em "stopped", "inactive", "standby", depende do caso.
 
     -  O Front-end se comunica diretamente com o banco validando na tabela de "nodes" qual o node active e assim realiza a conexão com o node "active".
 
     - O banco de dados está configurado para replicar de formar Master/Master, ambos escrevem um no outro. 
       Caso o banco A fique down, o banco B tomará o lugar impedindo que o Zabbix fique down. 
       Quando o banco A ficar UP, ocorrerá uma sincronização de dados afim de ambos os bancos manterem os mesmos dados.
 
     -  O Zabbix-Server realizará a conexão com o Banco de Dados através do HAPROXY, que é responsável por realizar checkagens se a replicação está funcionando
        e se está disponível para conexão.
 
 <h1></h1>
 
 [Variaveis a ser definidas]
 
     - Necessário editar /archives/my.cnf - Definir IP do servidor 1 de MySQL
     - Necessário editar /archives/cnf-host2/my.cnf - Definir IP do servidor 2 de MySQL
     - Necessário editar o código aonde está setado o caminho do arquivo "vars.yaml", a opção a ser editada é "vars_files" no code YAML, necessário editar todos para o caminho aonde se encontra o "vars.yaml"
     - Necessário editar o arquivo vars.yaml, definir os ip's conforme os nomes das váriveis
     - Necessário editar o arquivo mysql-lag.php e alterar a variável 'password', setar a senha de acesso ao banco de dados MySQL servidor 1
     - Necessário utilizar o endereço '127.0.0.1' na tela de configuração (setup.php) do Zabbix, pois quem faz o trabalho de conexão é o HAPROXY
 
 [Pacotes necessários]
 
     - Necessário instalar:
       - python3 -m pip install PyMySQL[rsa]
       - python3 -m pip install pymysql
 
 
 <h1></h1>
 <div align="center">
 
  
  [Se gostou desse repositório]
  
      - Deixe sua estrelinha e compartilhe esse repositório!
  
 </div>
 
 
