$(document).ready(function() {
    $('.btn-plus').click(function() {
        $parentNode = $(this).parents('tr');
        totalPriceOfEachPizza();
        subTotalResults();
    })

    $('.btn-minus').click(function() {
        $parentNode = $(this).parents('tr');
        totalPriceOfEachPizza();
        subTotalResults();
    })

    function subTotalResults() {
        $finalResult = 0;
        $('#parentBody tr').each(function(index, row) {
            $finalResult += Number($(row).find('#total').text().replace('Kyats', ' '));
        })
        $('#totalPrice').html(`${$finalResult} Kyats`);
        $('#totalFinalPrice').html(`${$finalResult+3000} Kyats`);
    }

    function totalPriceOfEachPizza() {
        $price = Number($parentNode.find('#price').text().replace('Kyats', ' '));
        $quantity = $parentNode.find('#qty').val();
        $total = $price * $quantity;
        $parentNode.find('#total').html(`${$total} Kyats`);
    }


})