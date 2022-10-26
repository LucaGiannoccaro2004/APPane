class Xhr{
    
    constructor(method, path){
        this.method = method;
        this.host = "http://192.168.107.149/classi/5f/olivati/APPane/";
        this.path = path;
    }

    setHost(host){
        this.host = host;
    }

    makeRequest(onload, accept, formData){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = onload
        xhttp.open(this.method, this.host + this.path);
        xhttp.setRequestHeader("Accept", accept);
        if(formData == undefined)
            xhttp.send(); 
        else
            xhttp.send(formData);
    }

}