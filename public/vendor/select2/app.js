$(document).ready(function () {
    $('.contas_receber').select2({
        placeholder: "Nome ou Razão social",
        allowClear: true,
        "language": {
            "noResults": function () {
                return '<span class="text-danger">Cliente não encontrado</span> <a href="' + BASE_URL + 'clientes/add" target="_blank" class="btn btn-primary btn-sm">Cadastrar</a>';
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        }
    });

    $('.forma_pagamento').select2({
        placeholder: "Forma de pagamento",
        allowClear: true,
        "language": {
            "noResults": function () {
                return '<span class="text-danger">Forma não encontrada</span> <a href="' + BASE_URL + 'pagamentos/add" target="_blank" class="btn btn-primary btn-sm">Cadastrar</a>';
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        }
    });

    $('.vendedor').select2({
        placeholder: "Nome ou código",
        allowClear: true,
        "language": {
            "noResults": function () {
                return '<span class="text-danger">Vendedor não encontrado</span> <a href="' + BASE_URL + 'vendedores/add" target="_blank" class="btn btn-primary btn-sm">Cadastrar</a>';
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        }
    });

    $('.contas_pagar').select2({
        placeholder: "Nome ou Razão social",
        allowClear: true,
        "language": {
            "noResults": function () {
                return '<span class="text-danger">Fornecedor não encontrado</span> <a href="' + BASE_URL + 'fornecedores/add" target="_blank" class="btn btn-primary btn-sm">Cadastrar</a>';
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        }
    });

    $('.categoria').select2({
        placeholder: "Nome",
        allowClear: true,
        "language": {
            "noResults": function () {
                return '<span class="text-danger">Categoria não encontrada</span> <a href="' + BASE_URL + 'categorias/add" target="_blank" class="btn btn-primary btn-sm">Cadastrar</a>';
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        }
    });

    $('.marca').select2({
        placeholder: "Nome",
        allowClear: true,
        "language": {
            "noResults": function () {
                return '<span class="text-danger">Marca não encontrada</span> <a href="' + BASE_URL + 'marcas/add" target="_blank" class="btn btn-primary btn-sm">Cadastrar</a>';
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        }
    });

    $('.fornecedor').select2({
        placeholder: "Nome",
        allowClear: true,
        "language": {
            "noResults": function () {
                return '<span class="text-danger">Fornecedor não encontrada</span> <a href="' + BASE_URL + 'fornecedores/add" target="_blank" class="btn btn-primary btn-sm">Cadastrar</a>';
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        }
    })
});