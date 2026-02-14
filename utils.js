function redrawPrice(basePrice, months) {
    const priceDisplay = document.getElementById("price");
    const finalPriceInput = document.getElementById("final_price");

    basePrice = Number(basePrice);
    months = Number(months);

    if (isNaN(basePrice) || isNaN(months)) {
        console.error("Invalid values:", basePrice, months);
        return;
    }

    const finalPrice = (basePrice * months).toFixed(2);

    priceDisplay.textContent = finalPrice;
    finalPriceInput.value = finalPrice;
}
function getRentPeriodRent(startDate, months) {
    months = parseInt(months);
    const start = new Date(startDate);
    const end = new Date(start);
    end.setMonth(end.getMonth() + months);
    return end;
}
