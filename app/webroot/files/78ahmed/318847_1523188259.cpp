// writing on a text file
#include <iostream>
#include <fstream>
using namespace std;

int main () {
  ofstream myfile ("ex.txt");

    myfile << "This is a line.\n"
    myfile << "This is another line.\n";
    myfile.close();

  return 0;
}