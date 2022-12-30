import AbsPion from "./Pion";

class Tower extends AbsPion{
    constructor(imageUrl, color, startPosition){
        super(imageUrl, color, startPosition);
        
        imageUrl = imageUrl;
        color = color;
        startPosition = startPosition

    }
    patern(startPosition){
        super(imageUrl, color, startPosition);

        const startY = startPosition[1];
        const startX = startPosition[0];
        for (const i = 0;  i <= 7; i++) {
            if (startY+ i <= 7) {
                const tab2 = [[startX][startY + i]];
                return tab2; 
            } 
        }       
        
    }
}
export default Tower;