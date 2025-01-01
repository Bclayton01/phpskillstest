document.getElementById('productForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('index.php', {
        method: 'POST',
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            updateTable(data);
        });
});

function updateTable(data) {
    const recordsTable = document.getElementById('recordsTable');
    let tableHTML = `
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Date Submitted</th>
                    <th>Total Value</th>
                </tr>
            </thead>
            <tbody>
    `;

    let grandTotal = 0;

    data.forEach((item) => {
        tableHTML += `
            <tr>
                <td>${item.productName}</td>
                <td>${item.quantity}</td>
                <td>${item.price.toFixed(2)}</td>
                <td>${item.datetime}</td>
                <td>${item.totalValue.toFixed(2)}</td>
            </tr>
        `;
        grandTotal += item.totalValue;
    });

    tableHTML += `
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right font-weight-bold">Grand Total</td>
                    <td>${grandTotal.toFixed(2)}</td>
                </tr>
            </tfoot>
        </table>
    `;

    recordsTable.innerHTML = tableHTML;
}
