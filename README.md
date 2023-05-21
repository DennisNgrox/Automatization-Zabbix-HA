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
 
 <h1></h1>
 
 [Variaveis a ser definidas]
 
     - Em construção
 
 
 <h1></h1>
 <div align="center">
 
  
  [Se gostou desse repositório]
  
      - Deixe sua estrelinha e compartilhe esse repositório!
  
 </div>
 
 
