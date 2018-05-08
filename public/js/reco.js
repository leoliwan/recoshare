// numCom is a function to put comma in thousand numbers
function numCom(x) {
    x=String(x).toString();
    var afterPoint = '';
    if(x.indexOf('.') > 0)
       afterPoint = x.substring(x.indexOf('.'),x.length);
    x = Math.floor(x);
    x=x.toString();
    var lastThree = x.substring(x.length-3);
    var otherNumbers = x.substring(0,x.length-3);
    if(otherNumbers != '')
        lastThree = ',' + lastThree;
    return otherNumbers.replace(/\B(?=(\d{3})+(?!\d))/g, ",") + lastThree + afterPoint;
  }


function calculate_profit() {
    var shareNumber= parseInt(document.getElementById('shareNumber').value);
    var buy = parseFloat(document.getElementById('buy').value);
    var sell = parseFloat(document.getElementById('sell').value);
    var grossAmtBuy = (shareNumber * buy);
    var grossAmtSell = (shareNumber * sell);

    // Fees for Buying
    var commissionb = (grossAmtBuy * 0.0025);
    var vatb = (commissionb * 0.12);
    var sccpb = (grossAmtBuy * 0.0001);
    var pseb = (grossAmtBuy * 0.00005);
    var totalFeesBuy = commissionb + vatb + sccpb + pseb;
    var amountToPay = grossAmtBuy + totalFeesBuy;

    // Fees for Buying
    var commissions = (grossAmtSell * 0.0025);
    var vats = (commissions * 0.12);
    var sccps = (grossAmtSell * 0.0001);
    var pses = (grossAmtSell * 0.00005);
    var salesTax = (grossAmtSell * 0.006);
    var totalFeesSell = commissions + vats + sccps + pses + salesTax;

    // total profit
    var totalValueBuy = grossAmtBuy + totalFeesBuy;
    var totalValueSell = grossAmtSell - totalFeesSell;
    var totalProfit = totalValueSell - totalValueBuy;

    // For total value
    var totalValue = grossAmtBuy + totalProfit;

    // Profit Percentage
    var profitdiff = totalValueSell - totalValueBuy;
    var profitper = profitdiff / totalValueBuy * 100;

    // Amount to Pay
    document.getElementById("amountToPay").innerHTML = numCom(amountToPay.toFixed(2));

    // Total Fees
    document.getElementById("totalFeesBuy").innerHTML = numCom(totalFeesBuy.toFixed(2));
    document.getElementById("totalFeesSell").innerHTML = numCom(totalFeesSell.toFixed(2));

    // Profit
    document.getElementById("totalProfit").innerHTML = numCom(totalProfit.toFixed(2));
    document.getElementById("profitper").innerHTML = numCom(profitper.toFixed(2)) + " " + "%";

    // Total Value
    document.getElementById("totalValue").innerHTML = numCom(totalValue.toFixed(2));

}

function computeAmount() {
    var shareNumber = parseFloat(document.getElementById('shareNumber').value);
    var buy = parseFloat(document.getElementById('buy').value);
    var sell = parseFloat(document.getElementById('sell').value);
    var grossAmtBuy = (shareNumber * buy);
    var grossAmtSell = (shareNumber * sell);

    document.getElementById("grossAmtBuy").innerHTML = numCom(grossAmtBuy.toFixed(2));
    document.getElementById("grossAmtSell").innerHTML = numCom(grossAmtSell.toFixed(2));
}

function clearInputs() {
    document.getElementById('shareNumber').value = '';
    document.getElementById('buy').value = ' ';
    document.getElementById('sell').value = ' ';
    document.getElementById('grossAmtBuy').innerHTML = '---';
    document.getElementById('grossAmtSell').innerHTML = '--- ';
}

// Empty Search Validation

function IsEmpty(){
    if(document.forms['Form'].search.value === "")
    {
      alert("Please Type in Stock Code ");
      return false;
    }
      return true;
  }

  // Reco Rating Validation

function RateIsEmpty(){
    if(document.forms['RateForm'].rating.value === "Select Rating")
    {
      alert("Please Select Your Rating ");
      return false;
    }
      return true;
  }