

%this function is used to thining the image edges
function matrix_after_thining = thining(mag)

[row,col] = size(mag);
matrix_after_thining = zeros(row-2,col-2);

% I do 4 walk from the original matrix, from left->right, from right->left
% from top->down,from down->top,each walk consider the eight neighbor
% elements

% from left->right
for i=2:row-1
    
    for j=2:col-1
        if(mag(i,j) == 255)
           if(neighbor_count(mag,i,j) >= 4 || ((mag(i,j+1) == 255)&&(mag(i,j-1) == 255) )||...
               mag(i+1,j+1) == 255 || mag(i-1,j+1) == 255)
           matrix_after_thining(i-1,j-1) = 0;
%            else
%                matrix_after_thining(i-1,j-1) = 255;
           end
        end
    end
    
end

% from right->left
for i=2:row-1
    
    for j=(col-1):-1:2
        if(mag(i,j) == 255)
           if(neighbor_count(mag,i,j) >= 4 || ((mag(i,j-1) == 255)&&(mag(i,j+1)==255)) ||...
               mag(i+1,j-1) == 255 || mag(i-1,j-1) == 255)
                matrix_after_thining(i-1,j-1) = 255;
%            else
%                matrix_after_thining(i-1,j-1) = 255;
           end
        end
    end
    
end


% from top->down
for j=2:col-1
   for i=2:row-1
      if(mag(i,j) == 255)
         if(neighbor_count(mag,i,j) >= 4 || ((mag(i+1,j) == 255)&& (mag(i-1,j) == 255)) || ...
                 mag(i+1,j+1) == 255 || mag(i+1,j-1) == 255)
           matrix_after_thining(i-1,j-1) = 255;
%          else
%                matrix_after_thining(i-1,j-1) = 255;
         end
      end
   end
end

% from down->top
for j=2:col-1
   for i=(row-1):-1:2
      if(mag(i,j) == 255)
         if(neighbor_count(mag,i,j) >= 4 || ((mag(i-1,j) == 255)&&(mag(i+1,j)==255)) || ...
                 mag(i-1,j-1) == 255 || mag(i-1,j+1) == 255)
           matrix_after_thining(i-1,j-1) = 255;
%          else
%                matrix_after_thining(i-1,j-1) = 255;
         end
      end
   end
end
