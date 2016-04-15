
%this funtion is used to count the number of 1's in the given index in
%matrix,consider the eight connectivity
function num=neighbor_count(matrix,row,col)

num = (matrix(row-1,col-1) == 255) + (matrix(row-1,col) == 255) +...
       (matrix(row-1,col+1) == 255) + (matrix(row,col-1) == 255)+...
       (matrix(row,col+1) == 255) + (matrix(row+1,col-1) == 255)+...
       (matrix(row+1,col) == 255)+ (matrix(row-1,col+1) == 255);
        


