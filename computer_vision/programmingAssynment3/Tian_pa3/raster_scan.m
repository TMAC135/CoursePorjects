%% This function is implemented for the simple raster scan method.
% Input: union_set: dictionary for the union set data structure
%        histogram: the array which contains the intensity of pixels
%        image: binary image for region extraction
%       
% Output: labels: the matrix which label the connected region as the 
%                 same label. Notice that the default value is 0 which 
%                 indicate the background color.  
function labels = raster_scan(union_set,binary_image)

% next label initilization
next_label=1;

% label matrix is the label of the binary image
[row,col] = size(binary_image);
labels = zeros(row,col);%initial labels for all positions are 0

%padding the edge components to 1's and regard them as the background
binary_image(:,1:4) = ones(row,4);
binary_image(:,col-3:col) = ones(row,4);
binary_image(1:4,:) = ones(4,col);
binary_image(row-3:row,:) = ones(4,col);

%first pass: label the current index with west and north neighbors
for i = 2:row 
    for j=2:col
        
       if(binary_image(i,j) == 0)
           %the comment part below is the way in wikipedia, which share the
           %similar logic as the note
           
           %consider the west and north neighbors in the binary image
%           if(labels(i,j-1) ~= 0 && labels(i-1,j) ~= 0)%both west and north are labeled
%               
%               if(labels(i,j-1) ~= labels(i-1,j))
%               %union the west and north labels first
%               union(union_set,labels(i,j-1),labels(i-1,j),labels);
%               end
%               
%               %assign the current position to the min lable of west and north
%               labels(i,j) = min(labels(i,j-1),labels(i-1,j));
%               %append the current position to the set
%               union_set(num2str(labels(i,j))) = [union_set(num2str(labels(i,j))) i j];
%               
%           elseif(labels(i,j-1) ~= 0) %only west is labeled
%               
%               labels(i,j) = labels(i,j-1);
%               %append the current position to the set
%               union_set(num2str(labels(i,j))) = [union_set(num2str(labels(i,j))) i j];
%               
%           elseif(labels(i-1,j) ~= 0) %only north is labeled
%               
%               labels(i,j) = labels(i-1,j); 
%               %append the current position to the set
%               union_set(num2str(labels(i,j))) = [union_set(num2str(labels(i,j))) i j];
%                   
%           else %either west and north is labeled,assign a new label
%               
%               labels(i,j) = next_label;
%               union_set(num2str(next_label)) = [i j];%add the current index to the set
%               next_label = next_label +1;
%           end
           
          
%           if(binary_image4(i,j-1) == 0 && binary_image4(i-1,j) == 0)
%              if(labels(i-1,j) ~= labels(i,j-1))
%                  union_labels(union_set,labels(i,j-1),labels(i-1,j),labels);
%              end
%              labels(i,j) = min(labels(i,j-1),labels(i-1,j));
%              union_set(num2str(labels(i,j))) = [union_set(num2str(labels(i,j))) i j];
%              
             
          if(binary_image(i,j-1) == 0)
              labels(i,j) = labels(i,j-1);
              union_set(num2str(labels(i,j))) = [union_set(num2str(labels(i,j))) i j];
              
          elseif(binary_image(i-1,j) == 0)
              labels(i,j) = labels(i-1,j);
              union_set(num2str(labels(i,j))) = [union_set(num2str(labels(i,j))) i j];
          else
              labels(i,j) = next_label;
              union_set(num2str(next_label)) = [i j];
              next_label = next_label +1;
              
          end
          
           
       end
    end
end
%second pass: Union all connected labels
for i=2:row
   
    for j=2:col
       if(labels(i,j) ~= 0)
          if(labels(i-1,j) ~= 0 && labels(i,j-1) ~= 0 )
              if(labels(i-1,j) ~= labels(i,j-1))
              labels = union_labels(union_set,labels(i,j-1),labels(i-1,j),labels);
%               labels(i,j) = min(labels(i-1,j),labels(i,j-1));
              end
          end
           
       end
    end
end

