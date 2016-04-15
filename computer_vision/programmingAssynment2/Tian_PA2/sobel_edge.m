function binary_image = sobel_edge(filename)

sourcePic=imread(filename); %read the original picture
[row_original,col_original] = size(sourcePic);
% grayPic=mat2gray(sourcePic);
%convert to to grey scale image
grayPic = rgb2gray(sourcePic);
%imshow(grayPic);

%sobel operator for 
kernel_x = [-1,0,1;-2,0,2;-1,0,1];
kernel_y = [1,2,1;0,0,0;-1,-2,-1];
delta_x = conv2(grayPic,kernel_x);
delta_y = conv2(grayPic,kernel_y);

%get the magnitude and direction matrix base on delta_x and delta_y
[row,col] = size(delta_x);
mag = zeros(row,col);
% the direction matrix using atan2
dir = atan2(delta_y,delta_x);

%get the mag matirx based on the delta_x,delta_y
for i=1:row
   for j=1:col
       mag(i,j) = sqrt(delta_x(i,j)^2 + delta_y(i,j)^2);
   end
end


%normalize the magnitude matrix and set the threshold value
max_value = max(mag(:));
ratio = max_value/255;
for i=1:row
   for j=1:col
      mag(i,j) = floor(mag(i,j)/ratio);
      
%       %set the threshold value
      if(mag(i,j) > 20)
         mag(i,j) = 1;
      else
          mag(i,j) = 0;
      end
   end
end

%normalize the direction matrix and set the threshold mannually 
max_value = max(dir(:));
min_value = min(dir(:));
gap = max_value - min_value;
for i=1:row
   for j=1:col
      if ((dir(i,j) - min_value)/gap > 0.65 )
          dir(i,j) = 255;
      else
          dir(i,j) = 0;
      end
   end
end
% plot the mag and dir with orginal image
% figure,
% subplot(1,2,1)
% imshow(grayPic);
% subplot(1,2,2)
% imshow(mag);
% title('orginal image vs magnitude');

binary_image = mag;




