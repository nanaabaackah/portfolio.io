public class Solution {
    
    public static int convert(char rom){
        if(rom == 'I')
            return 1;
        if(rom == 'V')
            return 5;
        if(rom == 'X')
            return 10;
        if(rom == 'C')
            return 50;
        if(rom == 'D')
            return 500;
        if(rom == 'M')
            return 1000;
        return -1;
        
    }
    
    public int RomanToInt(string s) {
        int sum = 0;
        
        for(int i = 0; i < s.Length; i++){
            int curr = convert(s[i]);
            
            
            if(i + 1 < s.Length){
                int next = convert(s[i + 1]);
                
                if( curr >= next){
                    sum += curr;
                }
                else{
                    sum += next - curr;
                i++;
                }
            }
            
            else {
                sum += curr;
            }
                
        }
        return sum;
    }
    
    
}