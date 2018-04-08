// basic file operations
#include <iostream>
#include <fstream>
using namespace std;

int main () {

  int n,x,y;
  fstream input,output;
  
  input.open("INPUT.in",ios::in);
  output.open("OUTPUT.out",ios::out);
  
  input >> n;
  for(int i = 0; i < n ; i++)
  {
  		input >> x >> y;
  		output << x+y << endl;
  }


  input.close();
  output.close();
  return 0;
}