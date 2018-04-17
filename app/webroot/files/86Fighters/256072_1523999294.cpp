#include <iostream>
#include<fstream>
#include<bits/stdc++.h>
using namespace std;
int main()
{
    ifstream input(" Harry.in");
    ofstream output;
    output.open("Harry.out");


  int n,a[100],sum=0;
  input>>n;
  for(int i=0;i<n;i++)
  {
      input>>a[i];
  }
  sort(a,a+n);
  for(int i=1;i<n;i++)
  {
      sum+=a[i];
  }
  output<<sum<<endl;



output.close();
    return 0;
}