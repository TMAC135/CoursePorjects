

%% caculate the matrix given two matrix,
function matrix_after_convolution = conv2_byme(original_imag,operator)

[row1,col1] = size(original_imag);
[row2,col2] = size(operator);

%initilization for the result matrix
row = row1-row2+1;
col = col1-col2+1;
matrix_after_convolution = zeros(row,col);
 

for i=1:row
   for j=1:col
       %calculate the convolution result for each position, element wise
       %operation
       tmp = 0;
       for offset_x=0:(row2-1)
          for offset_y=0:(col2-1)
             tmp = tmp +  operator(offset_x+1,offset_y+1)*...
                original_imag(offset_x+i,offset_y+j);
          end
       end     
      matrix_after_convolution(i,j) = tmp;
   end
    
end

% matrix_after_convolution = conv2(original_imag,operator);


