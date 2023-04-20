# Regras de negócio

## Cadastros

- Usuários do sistema:
    Devem possuir os seguintes campos (dados):
        - Nome (Obrigatório): Contendo entre 3-50 caracteres
        - Sobrenome (Obrigatório): Contendo entre 3-50 caracteres
        - Email (Obrigatório/Único): Contendo no máximo de 60 caracteres, usado para login
        - Usuário (Obrigatório/Único): Contendo entre 3-50 caracteres
        - Senha (Obrigatório): Contendo entre 5-25 caracteres
        - Perfil: Administrador/Vendedor
    Permissões:
        - Administrador: Todos privilégios
        - Vendedor: Cadastro, edição e consulta de registro

- Configurações do sistema:
    Devem possuir os seguintes campos (dados):
        - Razão social (Obrigatório): Contendo entre 3-80 caracteres
        - Nome fantasia (Obrigatório): Contendo entre 3-80 caracteres
        - CNPJ (Obrigatório): Contendo extamente 14 números
        - IE (Obrigatório): Contendo no máximo 12 números
        - Telefone (Opcional): Contendo extamente 10 números incluso ddd
        - celular (Obrigatório): Contendo extamente 11 números incluso ddd
        - Email (Obrigatório): Contendo no máximo de 80 caracteres
        - Site (Opcional): Contendo no máximo 80 caracteres
        - CEP (Obrigatório): Contendo exatamente 8 números
        - Endereço (Obrigatório): Contendo no máximo 60 caracteres
        - Cidade (Obrigatório): Contendo no máximo 60 caracteres
        - Estado (Obrigatório): Contendo exatamente 2 caracteres
        - Número do endereço (Opcional): Contendo no máximo 6 caracteres
        - Observação (Opcional): Contendo no máximo 500 caracteres

- Clientes (PF ou PJ): FIXME: Pode ter status ativo/desativo
    Devem possuir os seguintes campos (dados):
        - Tipo (Obrigatório): Pessoa física ou Pessoa Jurídica
        - Nome ou Razão Social (Obrigatório): Contendo entre 3-80 caracteres
        - Sobrenome ou Nome fantasia (Obrigatório): Contendo entre 3-80 caracteres
        - Data nascimento (Opcional): Somente PF FIXME: Motivo de ofertar promoção e captar mais uma venda
        - CPF ou CNPJ (Obrigatório): Contendo extamente 11 ou 14 números
        - RG ou IE (Obrigatório): Contendo no máximo 9 ou 12 números
        - Email (Obrigatório): Contendo no máximo de 80 caracteres
        - Telefone (Opcional): Contendo extamente 10 números incluso ddd
        - celular (Obrigatório): Contendo extamente 11 números incluso ddd
        - CEP (Obrigatório): Contendo exatamente 8 números
        - Endereço (Obrigatório): Contendo no máximo 60 caracteres
        - Bairro (Obrigatório): Contendo no máximo 60 caracteres
        - Cidade (Obrigatório): Contendo no máximo 60 caracteres
        - Estado (Obrigatório): Contendo exatamente 2 caracteres
        - Número do endereço (Opcional): Contendo no máximo 6 caracteres
        - Complemento (Opcional): Contendo no máximo 60 caracteres
        - Observação (Opcional): Contendo no máximo 500 caracteres

- Vendedores (PF): FIXME: Pode ter status ativo/desativo
    Devem possuir os seguintes campos (dados):
        - Código (Obrigatório): Contendo no máximo de 80 caracteres
        - Nome Completo (Obrigatório): Contendo no máximo de 160 caracteres
        - CPF (Obrigatório): Contendo extamente 11 números
        - RG ou IE (Obrigatório): Contendo no máximo 9 números
        - Email (Obrigatório): Contendo no máximo de 80 caracteres
        - Telefone (Opcional): Contendo extamente 10 números incluso ddd
        - celular (Obrigatório): Contendo extamente 11 números incluso ddd
        - CEP (Obrigatório): Contendo exatamente 8 números
        - Endereço (Obrigatório): Contendo no máximo 60 caracteres
        - Bairro (Obrigatório): Contendo no máximo 60 caracteres
        - Cidade (Obrigatório): Contendo no máximo 60 caracteres
        - Estado (Obrigatório): Contendo exatamente 2 caracteres
        - Número do endereço (Opcional): Contendo no máximo 6 caracteres
        - Complemento (Opcional): Contendo no máximo 60 caracteres
        - Observação (Opcional): Contendo no máximo 500 caracteres

- Fornecedores (PF ou PJ): FIXME: Pode ter status ativo/desativo
    Devem possuir os seguintes campos (dados):
        - Tipo (Obrigatório): Pessoa física ou Pessoa Jurídica
        - Nome ou Razão Social (Obrigatório): Contendo entre 3-80 caracteres
        - Sobrenome ou Nome fantasia (Obrigatório): Contendo entre 3-80 caracteres
        - Data nascimento (Opcional): Somente PF
        - CPF ou CNPJ (Obrigatório): Contendo extamente 11 ou 14 números
        - RG ou IE (Obrigatório): Contendo no máximo 9 ou 12 números
        - Email (Obrigatório): Contendo no máximo de 80 caracteres
        - Telefone (Opcional): Contendo extamente 10 números incluso ddd
        - celular (Obrigatório): Contendo extamente 11 números incluso ddd
        - CEP (Obrigatório): Contendo exatamente 8 números
        - Endereço (Obrigatório): Contendo no máximo 60 caracteres
        - Bairro (Obrigatório): Contendo no máximo 60 caracteres
        - Cidade (Obrigatório): Contendo no máximo 60 caracteres
        - Estado (Obrigatório): Contendo exatamente 2 caracteres
        - Número do endereço (Opcional): Contendo no máximo 6 caracteres
        - Complemento (Opcional): Contendo no máximo 60 caracteres
        - Observação (Opcional): Contendo no máximo 500 caracteres

- Serviços: FIXME: Pode ter status ativo/desativo
    Devem possuir os seguintes campos (dados):
        - Nome (Obrigatório): Contendo no máximo 80 caracteres
        - Preço (Obrigatório): Contendo no máximo 20 caracteres
        - Descrição (Opcional): Contendo no máximo 500 caracteres

- Marcas: FIXME: Pode ter status ativo/desativo
    Devem possuir os seguintes campos (dados):
        - Nome (Obrigatório): Contendo no máximo 80 caracteres

- Categorias: FIXME: Pode ter status ativo/desativo
    Devem possuir os seguintes campos (dados):
        - Nome (Obrigatório): Contendo no máximo 80 caracteres

- Produtos: FIXME: Pode ter status ativo/desativo
    Devem possuir os seguintes campos (dados):
        - Código (Obrigatório): Contendo no máximo de 10 caracteres
        - Código de barras (Opcional): Contendo no máximo de 20 caracteres
        - Código NCM (Opcional): Contendo no máximo de 20 caracteres
        - Nome (Obrigatório): Contendo no máximo 80 caracteres
        - Categoria (Obrigatório)
        - Marca (Obrigatório)
        - Fornecedor (Obrigatório)
        - Descrição 'Nome' (Obrigatório): Contendo no máximo de 80 caracteres
        - Unidade medida (Obrigatório): Contendo no máximo de 10 caracteres
        - Preço de custo (Obrigatório): Contendo no máximo de 10 caracteres
        - Preço de venda (Obrigatório): Contendo no máximo de 10 caracteres
        - Quantidade de estoque mínimo (Obrigatório): Contente no máximo 10 caracteres
        - Quantidade de estoque (Obrigatório): Contente no máximo 10 caracteres
        - Observação (Opcional): Contendo no máximo 500 caracteres

- Conta à pagar: FIXME: Pode ter status ativo/desativo
    Devem possuir os seguintes campos (dados):
        - Fornecedor (Obrigatório)
        - Preço de conta (Obrigatório): Contendo no máximo de 10 caracteres
        - Data de vencimento (Obrigatório)
        - Data de vencimento (Opcional)
        - Observação (Opcional): Contendo no máximo 500 caracteres

- Conta à receber: FIXME: Pode ter status ativo/desativo
    Devem possuir os seguintes campos (dados):
        - Cliente (Obrigatório)
        - Preço de venda (Obrigatório): Contendo no máximo de 10 caracteres
        - Data de vencimento (Obrigatório)
        - Data de vencimento (Opcional)
        - Observação (Opcional): Contendo no máximo 500 caracteres

- Formas de pagamentos: FIXME: Pode ter status ativo/desativo
    Devem possuir os seguintes campos (dados):
        - Nome (Obrigatório): Contendo no máximo 80 caracteres

- Ordens de serviços: FIXME: Pode ter status ativo/desativo
    Devem possuir os seguintes campos (dados):
        - Serviço (Obrigatório)
        - Forma de pagamento (Opcional)
        - Cliente (Obrigatório)
        - Descrição (Obrigatório): Contendo no máximo 80 caracteres
        - Equipamento (Opcional): Contendo no máximo 80 caracteres
        - Marca equipamento (Opcional): Contendo no máximo 80 caracteres
        - Modelo equipamento (Opcional): Contendo no máximo 80 caracteres
        - Valor de desconto (Opcional): Contendo no máximo 10 caracteres
        - Valor total (Obrigatório): Contendo no máximo 10 caracteres
        - Acessórios (Opcional): Contendo no máximo 500 caracteres
        - Defeitos (Opcional): Contendo no máximo 500 caracteres
        - Observação (Opcional): Contendo no máximo 500 caracteres

- Vendas: FIXME: Pode ter status ativo/desativo
    Devem possuir os seguintes campos (dados):
        - Produto (Obrigatório)
        - Forma de pagamento (Opcional)
        - Cliente (Obrigatório)
        - Vendedor (Obrigatório)
        - Tipo pagamento (Opcional)
        - Valor de desconto (Opcional): Contendo no máximo 10 caracteres
        - Valor total (Obrigatório): Contendo no máximo 10 caracteres

## Desativação e exclusão

- Registros só pode ser desativado se não houver pendências, e aqueles que possuem informações dentro de outro registro não podem ser excluídos. Ex.: Categoria não pode ser excluída, pois, está em uso por Produto.
    Mensagem de informação e erro:
        - `Este registro não pode ser desativado, pois está em uso.`
        - `Este registro não pode ser excluído, pois está em uso.`
- Registros só podem ser excluídos pelo administrador do sistema.
    Mensagem de erro:
        - `Perfil não tem permissão para excluir registro.`
- Qualquer erro que ocorrer durante a exclusão que não foi atendida anteriormente irá cair, em um erro amplo, devendo ser atualizado a página e tentar novamente.
    Mensagem de erro:
        - `Falha na tentativa de excluir o registro.`
