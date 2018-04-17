#include <fstream>
using namespace std;

int main()
{ ifstream input ("Harry.in");
ofstream output;
output.open(" Harry.out");


   int n,w,d,sub=0;
  input>>n>>w>>d;
   sub=(n-d)*w;



    output <<sub ;

    output.close();
}
