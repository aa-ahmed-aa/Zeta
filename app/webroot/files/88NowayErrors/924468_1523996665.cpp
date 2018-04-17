#include<stdio.h>
#include<string.h>
int main()
{
    int n;
    scanf("%d",&n);
    int x[n];

    for(int i=0;i<n;i++){
        scanf("%d",&x[i]);
    }


    for (int i=0;i<n;i++){
        int k=0;
        for(int j=i;j<n;j++){
            k=k+x[j];
            if(k==0){
                printf("Happy");
                return 0;
            }



        }
    }

    printf("Depressed");
    return 0;
}
