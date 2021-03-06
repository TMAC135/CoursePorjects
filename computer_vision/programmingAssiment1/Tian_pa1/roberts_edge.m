

%% robert operator for edge detection

clear;
sourcePic=imread('test4.jpg'); %read the original picture
[row_original,col_original] = size(sourcePic);
% grayPic=mat2gray(sourcePic);
%convert to to grey scale image
grayPic = rgb2gray(sourcePic);
%imshow(grayPic);

%robert operator for 
kernel_x = [0,1;-1,0];
kernel_y = [1,0;0,-1];
delta_x = conv2(grayPic,kernel_x);
delta_y = conv2(grayPic,kernel_y);

%get the magnitude and direction matrix base on delta_x and delta_y
[row,col] = size(delta_x);
mag = zeros(row,col);
dir = atan2(delta_y,delta_x);

for i=1:row
   for j=1:col
       mag(i,j) = sqrt(delta_x(i,j)^2 + delta_y(i,j)^2);
  
   end
end

%normalize the magnitude matrix and set the threshold mannually
max_value = max(mag(:));
ratio = max_value/255;
for i=1:row
   for j=1:col
      mag(i,j) = floor(mag(i,j)/ratio);
      
      %set the threshold value mannually
      if(mag(i,j) > 20)
         mag(i,j) = 255;
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

%% plot the mag and dir with orginal image
figure,
subplot(2,1,1)
imshow(grayPic);
subplot(2,1,2)
imshow(mag);
title('orginal image vs magnitude');

figure,
subplot(2,1,1)
imshow(grayPic);
subplot(2,1,2)
imshow(dir);
title('orginal image vs direction');

%here we use the build in function to check the correctness of our code
roberts_matlab = edge(grayPic,'roberts'); 
figure
subplot(2,1,1)
imshow(grayPic);
subplot(2,1,2)
imshow(roberts_matlab);
title('matlab build in roberts operator');


%% Thining step: we do the thining step for the mag matrix with eight connectivity
figure,imshow(mag);

% first we do the expension for the mag 
mag_after_expension = expension(mag);
figure,imshow(mag_after_expension);

% then do the thining step for the expension matrix
mag_after_thining = thining(mag_after_expension);
figure,imshow(mag_after_thining);


