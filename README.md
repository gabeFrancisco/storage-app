# Projeto Backend Laravel

Este documento irá fornecer o passo-a-passo para a implementação total de uma API RESTful feita em Laravel utilizando banco de dados MySQL.

É aconselhável um conhecimento prévio em PHP nos seguintes tópicos: 

 - Variáveis e Escopo
 - Funções
 - Orientação a objetos

No lado do Laravel nós iremos lidar principalmente com:
- **Eloquent:** biblioteca ORM(Object-Relational Mapping ou Mapeamento Objeto-Relacional) que irá transformar nossos modelos de código PHP em tabelas, funções e transações em nosso banco de dados SQL, sem precisar escrever nenhum código da mesma.
- **Tymon JWT Auth:** biblioteca para gerar e gerenciar tokens JWT
- **Postman:** para testar nossas rotas RESTful

## Checklist

 1. **Verificar as credenciais de conexão(no XAMPP, phpMyAdmin, etc) e inserir no arquivo de variáveis `.env` na raiz do projeto:** 

> DB_CONNECTION=mysql
>     	DB_HOST=localhost
>     	DB_PORT=3306
>     	DB_DATABASE=laravel_app
>     	DB_USERNAME=root
>     	DB_PASSWORD=1234

2. **Criar as Models** :

As models irão representar as nossas entidades no sistema e no banco de dados como um todo. Elas serão o centro de nosso projeto. Tudo é feito em cima das models. O Laravel por padrão já cria o model `User` no momento de criação do projeto e este não iremos mexer no momento.

Vamos criar as models `Category` e `Product` respectivamente. Para criar, usaremos o comando do Laravel chamado `make:model`, ou seja:
  

>  php artisan make:model Category 
>  php artisan make:model Product

As models ficam na pasta **app/Http/Models**

O framework criará no banco de dados uma tabela com o nome da model que colocamos, mas opcionalmente podemos dizer ao Eloquent um nome diferente diretamente na classe da model:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   //Através da variável $table nós podemos mudar o nome
   //no caso, vou chama-la de tb_produtos
    protected $table = 'tb_produtos';
}
```
Isso vale também para o model Category!

3. **Criar migrations**

Após criadas, iremos gerar nossas migrations com o comando `make:migration`

O que é uma migration? É um arquivo que define o esquema do nosso banco de dados através do próprio código no qual estamos trabalhando, ou seja: PHP! Vamos definir a estrutura de nossas tabelas via funções e construtores do PHP, sem precisar escrever uma linha de SQL. 

Rode o comando abaixo para gerar uma migration com o nome **create_category_product**:

    php artisan make:migration create_category_product
   
 Veremos o arquivo: gerado na pasta **database/migrations**:
 ```php
 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return  new  class  extends  Migration{
/**
* Run the migrations.
*/
	public  function  up():  void {
		Schema::create('category_product', function (Blueprint  $table) {
			$table->id();
			$table->timestamps();
		});
	}
  
/**
* Reverse the migrations.
*/
	public  function  down():  void
	{
		Schema::dropIfExists('category_product');
	}
};
 ```
 
Na função `up()` vamos mudar o nome **'category_product'** para apenas **'category'**. 

```php
	public  function  up():  void {
		Schema::create('category', function (Blueprint  $table) {
			$table->id();
			$table->timestamps();
		});
	}
```
Vou comentar no código cada linha da função `up():`
```php
		Schema::create('category', function (Blueprint  $table) {});
```
A classe `Schema` é um tipo especial do Eloquent que ira gerenciar a criação e modificação de nossas tabelas: Temos o método `::create` e posteriormente veremos o método `::table`. 
O primeiro argumento é o nome da tabela, nesse caso, 'category' e o segundo é uma função callback que chamará no banco de dados as funções de criação.

```php
	//Define a coluna 'id' na tabela do banco. Por padrão ela vem com o tipo bigint
	$table->id();
	//Define as colunas 'created_at' e 'updated_at' com o tipo timestamp
	$table->timestamps();
```
Dentro do escopo da função de callback teremos a disposição a variável `$table`. É com ela que teremos acesso ao banco de dados. 

A categoria mais básica pode ter **nome** e **descrição**. Vamos criar elas!
```php
	$table->string('name');
	$table->string('description')
```
Quando quisermos criar uma coluna de varchar(texto) no banco, usamos o método string('nome da coluna'), int para inteiros, etc;

Após isso, vamos executar o comando migrate para aplicar nossas modificações no banco:

    php artisan migrate

Se der tudo certo, teremos uma tabela `category` criada no MySQL.
 
 

