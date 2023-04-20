# :desktop_computer: Ordem system

TODO:

- Remember, Register, Recovery
- Corrigir badge (ativo/situação) com btn-sm
- Data vencimento serviço
- Rever quantidade máxima monetária
- Remover do buscar serviço/produto deve atualizar os valores
- Adcionar infor message servico min add.php ordens_servicos
- Bug de pelo 1 produto no edit de vendas

## :sparkles: Goal

- **Sistema:** Controle de estoque e lançamento de prestação de serviços.

## :briefcase: Stacks

✅ JavaScript
✅ PHP
✅ Bootstrap
✅ CodeIgniter
✅ MySQL
✅ SQL

## :hammer: Tools

- Git (`git -v`)
- VS Code

## :fire: Run

- URL: `http://localhost:80/ordem`

## :unicorn: Author

<table>
  <tr>
    <td align="center">
      <a href="https://github.com/bhigoreduardo">
        <img src="https://avatars.githubusercontent.com/u/96431991?v=4" width="100px;" alt="Foto do Higor Eduardo no GitHub"/><br>
        <sub>
          <b>Higor Eduardo</b>
        </sub>
      </a>
    </td>
  </tr>
</table>

## :ok_man: Dependencies

- CodeIgniter: `https://codeigniter.com/`
- SbAdmin2: `https://startbootstrap.com/theme/sb-admin-2`
- IonAuth: `http://benedmunds.com/ion_auth/`
- Translate DataTables: `https://datatables.net/plug-ins/i18n/Portuguese-Brasil`
- CodIgniter Translate: `https://github.com/bcit-ci/codeigniter3-translations`
- jQuery Mask: `https://igorescobar.github.io/jQuery-Mask-Plugin/`
- Select2: `https://github.com/select2/select2`
- Dompdf: `https://github.com/dompdf/dompdf`

## :page_facing_up: Docs

### :bookmark: Funcionalidades

- **config:** Diretório de configurações e informações de fácil acesso.
  *autoload:* Load de libs a serem utilizadas.
  *config:* Configurações globais.
  *database:* Configurações de conexão com banco de dados.
  *hooks:*
  *routes:* Mapeamento dos end-points a qual controller deve ser executado.
- **models:** Diretório responsável por fazer a conexão e comunicação com banco de dados.
- **controllers:** Processador de dados a entregar para a view, sendo acessado pela url e os end-points dos seus métodos.
- **views:** Diretório de arquivos que serão entregues ao cliente.
- **helpers:** Diretório de códigos auxiliares de funcionalidade do sistema como cálculos matemáticos, replace, mask.
- **hooks:**
- **language:** Diretório com textos estáticos traduzidos

### :bookmark: Fundamentals

- **MVC Pattern:** Padrão de projeto dividido em Model, View e Controller.
- **.htaccess:** Manter url amigável do sistema no root do app.
- **Proteção controller:** `defined('BASEPATH') OR exit('Ação não permitida');`

### :bookmark: Steps

#### :bookmark: Settings

- Desabilitar warning deprecated:
  Em `index.php` inserir `ini_set('error_reporting', E_ALL & ~E_DEPRECATED);`
- Habilitar url amigável .htaccess
- Definir página inicial:
  Em `application/config/routes` definir em `$route['default_controller'] = 'home';`
- Instalar template SbAdmin2 Bootstrap:
  Em `application/config/autoload` carregar `$autoload['helper'] = array('url');`
  Em `application/config/config` definir `$config['base_url'] = 'http://localhost/ordem/';` e `$config['index_page'] = '';`
- Instalar gerenciador de usuários `ion auth`:
  Em `application/config` copiar `ion_auth.php`
  Em `application/models` copiar `ion_auth_models.php`
  Em `application/language/english` copiar `auth_lang.php` e `ion_auth_lang.php`
  Em `application/language/portuguese-brazilian` copiar após adicionar o codigniter translates `auth_lang.php` e `ion_auth_lang.php`
  Em `application/libraries` copiar `ion_auth.php`
  Em `application/config/autoload` carregar `$autoload['libraries'] = array('ion_auth', 'database');`
  Criar banco de dados `ordem` e importar `ion_auth.sql`
  Em `application/config/database` definir `[hostname/username/password/database]`
- Estruturação do template:
  Em `application/views` separar o template em `header, sidebar, navbar e footer` e injetar `header` e `footer` nos controllers
  Em `header e footer` fazer carregamento dinâmico dos `css e js`
- Criar o core_model para crud básico dos dados:
  Em `application/models` criar os método para `Core_model`
- Importar livesearch do plugin datatable, traduzir e desordenar coluna ações com class `nosort`
  Em `public/vendor/datatables` carregar no header e footer os css e js
  Em `public/vendor/datatables/app.js` definir toda a tradução dos tables
- Habilitar o form validation e traduzir as informações:
  Em `application/config/autoload` carregar `$autoload['libraries'] = array('ion_auth', 'database', 'form_validation');`
  Em `application/language` copiar `portuguese-brazilian` do codeigniter translates
  Em `application/config/config` definir `$config['language'] = 'portuguese-brazilian';`
- Habilitar session para gerenciar estado:
  Em `application/config/autoload` carregar `$autoload['libraries'] = array('ion_auth', 'database', 'form_validation', 'session');`
- Habilitar core_model para comunicação com banco de dados:
  Em `application/config/autoload` carregar `$autoload['model'] = array('core_model');`
- Habilitar security para validação de inject SQL e array para debug de `$data`:
  Em `application/config/autoload` carregar `$autoload['helper'] = array('url', 'security', 'array');`
- Desabilitar `active` default do ion auth:
  Em `application/model/Ion_auth_model.php [row: 856]` comentar `'active' => ($manual_activation === FALSE ? 1 : 0)`
- Habilitar XSS Clean de forma global:
  Em `application/config/config` e setar `$config['global_xss_filtering'] = TRUE;`
- Import jQuery Mask:
  Em `public/vendor/mask` os arquivos `app.js` e `jquery.mask.min.js`
- Criar helper formatação de data do banco:
  Em `application/helper` criar `funcao_helper.php` com métodos com/sem hora
  Em `application/config/autoload` carregar `$autoload['helper'] = array('url', 'security', 'array', 'funcao');`
- Importar script de manipulação do tipo de cliente cadastrado:
  Em `public/js` importar `clientes.js`
- Habilitar helper string para utilizar generate code:
  Em `application/config/autoload` importar `$autoload['helper'] = array('url', 'security', 'array', 'funcao', 'string');`
- Importar select2
  Em `public/vendor` importar `Select2` para permitir busca customizada js com possível cadastro
  Em `public/js/demo` importar `util.js` e carregar no footer para habilitar efeitos fade
- Definir data/hora América/São Paulo
  Em `application/config/config` configurar `date_default_timezone_set('America/Sao_Paulo');`
- Configurar rotas não amigáveis
  Em `application/config/routes`
- Importar dompdf para o projeto:
  Em `root` importar `dompdf`
- Importar o library pdf:
  Em `application/libraries` importar `Pdf.php`
- Carregar em pdf
  Em `config/config/autoload`carregar `$autoload['libraries'] = array('ion_auth', 'database', 'form_validation', 'session', 'Pdf');`
- Importar plugins
  Em `public/vendor` importar `autocomplete` para request ajax
  Em `public/vendor` importar `calcx` para manipulação de cálculos matemáticos
  Em `public/vendor` importar `sweetalert2` para mostrar mensagens de alertas
- Hospedagem do sistema
  Em `aplication/config/database.php` setar para `'stricton' => true`
  Limpar dados da tabela `login_attempts`
  Backup da base de dados
  Copiar arquivo `unzipper.php` no root do sistema e upload na nuvem em `public_html`
  Em `config/config.php` alterar `$config['base_url'] = 'https://inovaresoft.000webhostapp.com/';` url do site
  Em `public/js/demo/utils.js` alterar `const BASE_URL = "https://inovaresoft.000webhostapp.com/";` url do site
  Em `config/config/database.php` alterar `'username' => 'id20321288_root',` usuário do banco
  Em `config/config/database.php` alterar `'password' => 'U66sqZ2]y5(^_J6]',` senha do banco
  Em `config/config/database.php` alterar `'database' => 'id20321288_ordem',` nome do banco
  Importar banco de dados e upload do sistema zipado
  Realizar unzip do sistema acessando o end-point `https://inovaresoft.000webhostapp.com/unzipper.php` e subir level de todos arquivos
  Em `application/language/portugues-brazilian/form_validation_lang.php` remover erro no início do arquivo

##### :bookmark: Custom Files

- Styles:
  Em `public/css/app.css`
- JavaScript:
  Em `public/vendor/databatables/app.js`
