document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        let valid = true;
        let messages = [];

        // Validação do campo descrição
        const descricao = document.querySelector('input[name="descricao"]');
        descricao.value = descricao.value.trim();
        if (descricao.value === '') {
            valid = false;
            messages.push('O campo descrição é obrigatório.');
        }

        // Validação do campo categoria
        const categoria = document.querySelector('input[name="categoria"]');
        categoria.value = categoria.value.trim();
        if (categoria.value === '') {
            valid = false;
            messages.push('O campo categoria é obrigatório.');
        }

        // Validação do campo tamanho
        const tamanho = document.querySelector('input[name="tamanho"]');
        tamanho.value = tamanho.value.trim();
        if (tamanho.value === '') {
            valid = false;
            messages.push('O campo tamanho é obrigatório.');
        }

        // Validação do campo cor
        const cor = document.querySelector('input[name="cor"]');
        cor.value = cor.value.trim();
        if (cor.value === '') {
            valid = false;
            messages.push('O campo cor é obrigatório.');
        }

        // Validação do campo quantidade
        const quantidade = document.querySelector('input[name="quantidade"]');
        quantidade.value = quantidade.value.trim();
        if (quantidade.value === '' || isNaN(quantidade.value) || quantidade.value <= 0) {
            valid = false;
            messages.push('O campo quantidade é obrigatório e deve ser um número positivo.');
        }

        // Validação do campo preco_custo
        const precoCusto = document.querySelector('input[name="preco_custo"]');
        precoCusto.value = precoCusto.value.trim();
        if (precoCusto.value === '' || isNaN(precoCusto.value) || precoCusto.value <= 0) {
            valid = false;
            messages.push('O campo preço de custo é obrigatório e deve ser um número positivo.');
        }

        // Validação do campo preco_venda
        const precoVenda = document.querySelector('input[name="preco_venda"]');
        precoVenda.value = precoVenda.value.trim();
        if (precoVenda.value === '' || isNaN(precoVenda.value) || precoVenda.value <= 0) {
            valid = false;
            messages.push('O campo preço de venda é obrigatório e deve ser um número positivo.');
        }

        // Validação do campo fornecedor (opcional)
        const fornecedor = document.querySelector('input[name="fornecedor"]');
        fornecedor.value = fornecedor.value.trim();
        // Não é necessário validar o campo fornecedor, pois é opcional

        if (!valid) {
            event.preventDefault();
            alert(messages.join('\n'));
        }
    });
});
