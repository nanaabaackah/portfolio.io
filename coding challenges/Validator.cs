using System;
using System.Text.RegularExpressions;

class MainClass {

  public static string CodelandUsernameValidation(string str) {

    // code goes here  
    string valid = "false";

    string pattern = @"^([a-zA-Z])([a-zA-Z0-9_])+$";
    
    for(int i = 0; i <= str.Length; i++){
      if(str.Length > 4 && str.Length < 25 && str[str.Length-1] != '_' &&
      Regex.IsMatch(str, pattern)){
      valid = "true";
      }
      
    }
    
    return valid;
   
  }

  static void Main() {  
    // keep this function call here
    Console.WriteLine(CodelandUsernameValidation(Console.ReadLine()));
  } 

}