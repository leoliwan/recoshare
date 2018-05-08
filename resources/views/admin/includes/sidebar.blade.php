<div class="col-md-4 col-lg-3 stock-profit">
    <div class="card-body bg--secondary p-1 pt-2 px-3">
        <h5 class="text-white text-center">Stock Profit Calculator</h5>
    </div> 
    <div class="card-body border p-0">
        <table class="table table-bordered mb-0">
            <thead class="bg--default text-white">
                <th class="py-1">Stock Code</th>
                <th class="py-1">No. of Shares</th>
            </thead>
            <tbody>
                <td><input class="form-control"></td>
                <td><input id="shareNumber" type="number" class="form-control" onkeyup="computeAmount()"></td>       
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead class="bg--default text-white text-center">
                <th class="py-1">Transaction</th>
                <th class="py-1">Buy</th>
                <th class="py-1">Sell</th>
            </thead>
            <tbody>
                <td class="py-1">Price/Share</td>
                <td class="py-1"><input id="buy" type="number" class="form-control" onkeyup="computeAmount()"></td>
                <td class="py-1"><input id="sell" type="number" class="form-control" onkeyup="computeAmount()"></td>       
            </tbody>
            <tbody>
                <td class="py-1">Gross Amt.</td>
                <td class="py-1" id="grossAmtBuy">---</td>
                <td class="py-1" id="grossAmtSell">---</td>       
            </tbody>
            <tbody>
                <td class="py-1">Total Fees</td>
                <td class="py-1" id="totalFeesBuy">---</td>
                <td class="py-1" id="totalFeesSell">---</td>       
            </tbody>
            <tbody>
                <td class="py-1" style="width:40%;">Amount to pay</td>
                <td class="py-1" id="amountToPay">---</td>    
            </tbody>
        </table>
        <div class="container text-center">
             <button onclick="calculate_profit()" class="btn btn--warning mb-3">Calculate</button>
             <button onclick="clearInputs()" class="btn btn--primary mb-3">Clear</button>
        </div>
        <table class="table table-bordered">
            <thead class="bg--default text-white text-center">
                <th class="py-1"></th>
                <th class="py-1">Amount</th>
                <th class="py-1">Percentage</th>
            </thead>
            <tbody>
                <td class="py-1" style="color:green">Profit/<span style="color:red">Loss</span></td>
                <td class="py-1" id="totalProfit">---</td>
                <td class="py-1" id="profitper"></td>       
            </tbody>
            <tbody>
                <td class="py-1" style="width:40%;"><strong>Total Value</strong></td>
                <td class="py-1" id="totalValue">---</td>    
            </tbody>
        </table>
        <p id="results"></p>
    </div>
</div>
