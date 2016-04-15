
%this function is used to expend the mag matrix
function matrix_after_expension = expension(mag)

[row,col] = size(mag);

matrix_after_expension = zeros(row-2,col-2);

for i=2:row-1
   
    for j=2:col-1
        
       if(mag(i,j) == 0)
%           sum = mag(i-1,j) + mag(i,j-1) + mag(i+1,j) + mag(i,j+1);
            sum = neighbor_count(mag,i,j);
          if(sum >= 3)
             matrix_after_expension(i-1,j-1) = 255; 
          end
%        else
%            matrix_after_expension(i-1,j-1) = 255;
       end
    end
    
end