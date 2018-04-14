#include <iostream>
#include <fstream>
using namespace std;

int main()
{
    fstream input("Add.in", ios::in);
    fstream output("Add.out", ios::out);
    int n,x,y;
    
    input >>n;
    for(int i= 0; i< n ; i++)
    {
        input >> x >> y;
	if( i == n-1 )
            output << x+y ;
 	else 
            output << x+ y << endl;
    }

    input .close();
    output.close();

    return 0;
}
