public class Solution {   
        
    public string IntToRoman(int num) {
        string answer = string.Empty;
        string[] roman = {"M", "CM", "D", "CD", "C", "XC", "L", "XL", "X", "IX", "V", 
                          "IV", "I"};
        int[] numbers = {1000, 900, 500, 400, 100, 90, 50, 40, 10, 9, 5, 4, 1};
        
        int i = 0;
        
        while(num != 0){
            if(num >= numbers[i]){
                num -= numbers[i];
                answer += roman[i];
            } else{
                i++;
            }
                
        }
        return answer;
    }
}
