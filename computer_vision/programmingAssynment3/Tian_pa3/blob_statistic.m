%% Calculate the  Blob statistic based on each labeled region

function [MBR centroid areas holes holes_areas perimeter elongation]...
            =blob_statistic(union_set,labels)

[row col] = size(labels);

% get the all sets
keys = union_set.keys;
values = union_set.values;
leng = length(keys);

% initilizations for each statistic
MBR = zeros(leng,4);
centroid = zeros(leng,2);
areas = zeros(leng,1);
holes = zeros(leng,1);
holes_areas = zeros(leng,1);
perimeter = zeros(leng,1);
elongation = zeros(leng,1);

num_offset = 8000;

% MBR
for i = 1:leng
   tmp = union_set(char(keys(i)));   
   %initilizations for 4 bounds
   min_x = 9999;
   min_y = 9999;
   max_x = -9999;
   max_y = -9999;
   for j=1:2:length(tmp)
       min_x = min(min_x,tmp(j));
       min_y = min(min_y,tmp(j+1));
       max_x = max(max_x,tmp(j));
       max_y = max(max_y,tmp(j+1));
   end
   MBR(i,:) = [min_x,min_y,max_x,max_y]; 
end

%centroid
for i=1:leng
    tmp = union_set(char(keys(i))); 
    sum_x = 0;
    sum_y = 0;
    for j=1:2:length(tmp)
       sum_x = sum_x + tmp(j);
       sum_y = sum_y + tmp(j+1);
    end
    centroid(i,:) = [sum_x*2/length(tmp),sum_y*2/length(tmp)];
end

% areas
for i=1:leng
    tmp = union_set(char(keys(i))); 
    areas(i) = length(tmp)/2;%just the number of count for the set
end

%holes and holes_areas
for i=1:leng
   tmp = union_set(char(keys(i)));
   
   %creat the binary image which only contains one label, then invert this 
   %image and use raster_scan to find the connected resgions, the
   %number of connected region for the inverted image is just the holes
   %with respect to this image
   img_tmp = zeros(row,col);
   set_tmp = containers.Map;
   for j=1:2:length(tmp)
      img_tmp(tmp(i),tmp(i+1)) = 1; 
   end
   %invert the image,if the index is out of MBR, we regard it as the background 
   for ii=1:row
      for jj=1:col
         if(ii <= MBR(i,1) || ii >= MBR(i,3) || jj <= MBR(i,2) || jj >= MBR(i,4)) 
             img_tmp(ii,jj) = 1;
         end
      end
   end
   
    %raster scan and refine labels for the inverted image
    labels_tmp = raster_scan(set_tmp,img_tmp);
    labels_tmp = refine_labels(set_tmp,labels_tmp,num_offset);
    
    %the holes number of keys in this union set
    holes(i) = length(set_tmp.keys);
    
    %the areas of holes are just the number of count in each values minus
    %the partial of the number of offset values
    tmp_keys = set_tmp.keys;
    if(holes(i) ~= 0)
        tmp = set_tmp(char(tmp_keys(1)));
        holes_areas(i) = ceil(length(tmp)/20 - num_offset/40);
    end
%     tmp_keys = set_tmp.keys;
%     for ii =1:holes(i)
%        tmp = set_tmp(char(tmp_keys(ii)));
%        holes_areas(i,ii) = length(tmp)/2;
%     end   
end

% perimeter
for i=1:leng
    tmp = union_set(char(keys(i)));
    
    %use the border follower to detect the bound of the region
    img_tmp = ones(row,col);
    for j=1:2:length(tmp)
      img_tmp(tmp(i),tmp(i+1)) = 0; 
    end
    
    %Use the direction to indicate which way we need to head in the next
    %step, direction = 1(right) 2(down) 3(left) 4(up).
    %The terminate case is when we get the starting point and the direction
    %is 1.
    
    %find the starting index
    flag = 0;
    for ii=1:row
       for jj=1:col
          if(img_tmp(ii,jj) == 0)
             start_x = ii;
             start_y = jj;
             flag = 1;
             break;
          end
       end
       if(flag == 1)
          break; 
       end
    end
    %for debug
    perimeter(i) = start_x;
    
    direction = 1;%initial direction is right   
    cur_x = start_x+1;
    cur_y = start_y+1; 
    while(cur_x ~= start_x && cur_y ~= start_y)%ending case is when we go back to the staring point
       perimeter(i) = perimeter(i) +1;
       switch direction
           % to the right
           case 1
               if(img_tmp(cur_x,cur_y+1) == 0)
                  cur_y = cur_y +1
                  direction = 1;
               elseif(img_tmp(cur_x+1,cur_y+1) == 0)
                   direction = 1;
                   cur_x = cur_x +1;
                   cur_y = cur_y +1;
               else
                  direction = 2;
                  cur_x = cur_x + 1;
               end
           % to the bottom 
           case 2             
               if(img_tmp(cur_x+1,cur_y) == 0)
                  cur_x = cur_x +1;
                  direction = 2;
               elseif(img_tmp(cur_x+1,cur_y-1) == 0)
                   direction = 2;
                   cur_x = cur_x +1;
                   cur_y = cur_y -1;
               else
                  direction = 3;
                  cur_y = cur_y - 1;
               end
           
           % to the left    
           case 3
               if(img_tmp(cur_x,cur_y-1) == 0)
                  cur_y = cur_y -1;
                  direction = 3;
               elseif(img_tmp(cur_x-1,cur_y-1) == 0)
                   direction = 3;
                   cur_x = cur_x -1;
                   cur_y = cur_y -1;
               else
                  direction = 4;
                  cur_x = cur_x - 1;
               end               
               
           %to the top                 
           case 4
               if(img_tmp(cur_x-1,cur_y) == 0)
                  cur_x = cur_x -1;
                  direction = 4;
               elseif(img_tmp(cur_x-1,cur_y+1) == 0)
                   direction = 4;
                   cur_x = cur_x -1;
                   cur_y = cur_y +1;
               else
                  direction = 1;
                  cur_y = cur_y + 1;
               end               
       end
       
    end
      
end

% elongation -> (p)^2/area
for i=1:leng
    elongation(i) = (perimeter(i)^2) / areas(i);    
end