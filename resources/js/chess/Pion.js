class AbsPion{
    constructor(imageUrl, color, startPosition){
        if (this.constructor === AbsPion) {
            throw new TypeError('Abstract class "AbsPion" cannot be instantiated directly');
            this.imageUrl = imageUrl;
            this.color = color;
            this.startPosition = startPosition;
        }
    }


    patern() {
        
        throw new Error('You must implement this function');
    }
}

export default AbsPion;