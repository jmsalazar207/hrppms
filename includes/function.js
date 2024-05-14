function number_format_js(number, seperator) {
    number = (number+'').replace(/[^\.\-0-9]/g, '');
    if(number.length >3){
        number = number.replace(/\B(?=(?:\d{3})+(?!\d))/g, seperator);
    }
    return number;
}