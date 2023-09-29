# Iniciando projeto
![image](https://github.com/Ktzani/Job-Application/assets/89881021/16d45ab8-01c2-4108-b56e-66571e84b064)


Com o repositorio clonado e aberto, primeiro é necessário baixar todas as dependencias executando: 
```
composer install
```

## Banco de dados - mysql
O banco a ser utilizado é buildado em um container no docker e, para isso, primeiro é necessário criar o .env file com os seguintes argumentos: 

```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:6Tu1KyOKKYR9hjP2Hes159C1QgVxKKoB/EYlvsvO1Sg=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST='127.0.0.1'
DB_PORT=3306
DB_DATABASE=job_api
DB_USERNAME=root
DB_PASSWORD='123'

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

SCOUT_DRIVER=meilisearch
MEILISEARCH_HOST=http://meilisearch:7700

MEILISEARCH_NO_ANALYTICS=false
```

Com o .env file em mãos, basta buildar o container com o seguinte comando: 

```
make up
```

### Migrations
Para criação da tabela de usuários e lojas, basta rodar o comando: 

```
make migrate
```

e caso seja necessário popular o banco a partir da .seed, basta executar o comando:

```
make seed
```

## Servidor 
Para iniciar o servidor do laravel, basta executar o seguinte comando: 

```
make start-server
```

- OBSERVAÇÃO: Para as funcionalidades do projeto, elas foram versionadas em V1 para caso mude algo futuramente. Por isso, todas as rotas se encontram em
```
http://127.0.0.1:8000/api/v1/<rota-desejada>
```

### Executando Testes

Para executar os testes para executar o comando: 

```
make test
```

### Rotas existentes
Para visualizar as rotas do servidor, basta executar o comando: 
```
php artisan route:list
```
Essas são as rotas oferecidas, sendo algumas publicas e outras privadas:

![image](https://github.com/Ktzani/Job-Application/assets/89881021/7c77aad1-0107-4dfc-8999-e9a4703e0f54)

- As rotas de login e cadastro (create) do usuário são rotas públicas e é por meio delas que ocorre a autenticação do usuário para que assim o mesmo consiga acessar as rotas privadas.
- As rotas privadas são de criação, atualização, leitura e deleçào das lojas e atualização, leitura e deleção dos usuários. Percebam que a criação do usuário é pública.
- Um usuário consegue fazer a leitura, atualização e deleção apenas das lojas as quais ele é dono.

**OBSERVAÇÃO**: Caso deseje visualizar todos os usuários e suas respectivas lojas também, basta utiliza a querry na url "includeLojas=true" como a seguir: 
```
http://127.0.0.1:8000/api/v1/usuarios?includeLojas=true
```


### Retornos JSON menores
Arquivos: app/Resources/V1

Para evitar de retornar todo e qualquer dado das tabelas após uma requisição, adicionou-se resources e collections, que selecionam quais dados dos models devem ser retornados e qual a formatação desses dados.

Exemplos:

- Resource de usuários
  
  ![image](https://github.com/Ktzani/Job-Application/assets/89881021/bab3504b-d026-4299-8a94-0f047b08d56d)

- Resource de lojas:

![image](https://github.com/Ktzani/Job-Application/assets/89881021/dc86520e-e131-4568-8d07-79d0594b723e)



### Validação
Arquivos: app/Requests/V1

Toda e qualquer validação em rotas (de criação, atualização de lojas e usuários e no login do usuário) é feita dentro do proprio request utilizando o recurso do FormRequest

Exemplos:

- Criação de usuario
  
![image](https://github.com/Ktzani/Job-Application/assets/89881021/9282a00c-db93-4ebc-a2e6-64eec7fd069b)

- Criação de loja
  
![image](https://github.com/Ktzani/Job-Application/assets/89881021/1a36bf19-4dce-4b91-b56d-c292368153bb)

- Login do usuário
  
![image](https://github.com/Ktzani/Job-Application/assets/89881021/1fe8627f-cf62-4f0e-82df-6f263811db6b)

- Atualização do usuário

![image](https://github.com/Ktzani/Job-Application/assets/89881021/765ea599-d3e8-4252-8784-8ed23eaae55d)

- Atualização da loja

![image](https://github.com/Ktzani/Job-Application/assets/89881021/63295b69-2736-4066-8239-d30b484f5db3)


### Filtros
Arquivos: app/Filters/V1

Para filtragem é necessário selecionar o campo e a operação a ser realizada com aquele campo, sendo que alguns campos tem certas operações e outros não, como por exemplo os campos numericos tem operações de >=, <=, >, <. 

- Essas são as operações existentes:
  
![image](https://github.com/Ktzani/Job-Application/assets/89881021/8230ec7b-5b84-4d2d-9aaa-1d0282ff84e6)

- Quais campos de usuários podem utilizar quais operações:
  
![image](https://github.com/Ktzani/Job-Application/assets/89881021/67cf16ae-7dfe-4421-8357-ad5b5c84500d)


- Quais campos de lojas podem utilizar quais operações:
  
![image](https://github.com/Ktzani/Job-Application/assets/89881021/b6e62f21-7587-4ac6-b996-d5d9f0ab0ffe)


Um exemplo de como se usar esses filtros seria: 

```
http://127.0.0.1:8000/api/v1/usuarios?nome[like]=%Jac%
```

ou

```
http://127.0.0.1:8000/api/v1/usuarios?nome[eq]=Clifton Jacobson I
```

ou 

```
http://127.0.0.1:8000/api/v1/lojas?uf[ne]=MG
```
ou

```
http://127.0.0.1:8000/api/v1/lojas?cep[gt]=50000
```
ou

```
http://127.0.0.1:8000/api/v1/lojas?numero[lte]=2000
```

### Paginação
Arquivos: Encontra-se dentro dos próprios controllers em app/Http/Controllers/Api/V1/

Para paginação, pode-se escolher a quantidade de itens por pagina seguindo a seguinte url com a query "per_page=integer"
```
http://127.0.0.1:8000/api/v1/lojas?per_page=30
```

### Acessando rotas - POSTMAN

Para facilitar os testes, subo aqui um workspace publico ao qual utilizei para testar requisições https://app.getpostman.com/join-team?invite_code=6d4e19a923289a5c3ea567944ecc96d8&target_code=05d00f40d1306f8faacca7a4639261be





