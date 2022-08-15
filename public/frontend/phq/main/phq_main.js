function timeSet(){
    setTimeout(function(){
        $(".alert").delay(5000).slideUp(300);
    });
}


const GSM_7BIT ="GSM_7BIT";
const GSM_7BIT_EX = "GSM_7BIT_EX";
const UTF16 = "UTF16";
const messageLength={GSM_7BIT:160, GSM_7BIT_EX:160, UTF16:70};
const multiMessageLength={GSM_7BIT:153, GSM_7BIT_EX:153, UTF16:67};

const gsm7bitExChar = "\\^{}\\\\\\[~\\]|â‚¬\n";
const gsm7bitChars = "@Â£$Â¥Ã¨Ã©Ã¹Ã¬Ã²Ã‡\\nÃ˜Ã¸\\rÃ…Ã¥Î”_Î¦Î“Î›Î©Î Î¨Î£Î˜ÎžÃ†Ã¦ÃŸÃ‰ !\\\"#Â¤%&'()*+,-./0123456789:;<=>?Â¡ABCDEFGHIJKLMNOPQRSTUVWXYZÃ„Ã–Ã‘ÃœÂ§Â¿abcdefghijklmnopqrstuvwxyzÃ¤Ã¶Ã±Ã¼Ã ";

const gsm7bitRegExp = RegExp("\n^["+gsm7bitChars+"]*$");
const gsm7bitExRegExp = RegExp("^["+gsm7bitChars+gsm7bitExChar+"]*$");
const gsm7bitExOnlyRegExp=RegExp("^[\\"+gsm7bitExChar+"]*$");

function detectEncoding(text){
    switch(false){
        case text.match(gsm7bitRegExp) == null:
            return GSM_7BIT;
        case text.match(gsm7bitExRegExp) == null:
            return GSM_7BIT_EX;
        default:
            return UTF16
    }
}
function countGsm7bitEx(text){
    var char2,chars;chars=function(){
        var _i,_len,_results;_results=[];

        for(_i=0,_len=text.length;_i<_len;_i++){
            char2=text[_i];
            if(char2.match(gsm7bitExOnlyRegExp) != null){
                _results.push(char2)
            }
        }
        return _results
    }.call(this);
    return chars.length
}

function calculatePartOfSMS(props){

    var encoding = detectEncoding(props);
    let length = props.length, per_message, messages, remaining;
    if(encoding === GSM_7BIT_EX){
        length += countGsm7bitEx(props);
    }
    per_message = messageLength[encoding];
    if(length > per_message){
        per_message = multiMessageLength[encoding];
    }
    messages = Math.ceil(length / per_message);
    remaining = per_message * messages-length;

    if(remaining == 0 && messages == 0){
        remaining = per_message;
    }

    var setSmsCharacterCount=length;
    var setSmsRemainingCount=remaining;
    var setSmsPartCount=messages;

    document.getElementById('encoding').innerHTML = encoding;
    document.getElementById('setSmsCharacterCount').innerHTML = setSmsCharacterCount;
    document.getElementById('setSmsRemainingCount').innerHTML = setSmsRemainingCount;
    document.getElementById('setSmsPartCount').innerHTML = setSmsPartCount;

}
 function defaultPartCounting(){
     document.getElementById('encoding').innerHTML = 'GSM_7BIT_EX';
     document.getElementById('setSmsCharacterCount').innerHTML = '0';
     document.getElementById('setSmsRemainingCount').innerHTML = '160';
     document.getElementById('setSmsPartCount').innerHTML = '0';
 }

