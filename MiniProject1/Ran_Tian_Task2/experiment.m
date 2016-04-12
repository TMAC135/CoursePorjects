
%this script is used to test the likelihood function
image = imread('0463.jpg');
size(image);

figure();
imshow(image);

% % method 1: use hsv to detect the pink value
% hsv = rgb2hsv(image);
% l=hsv(:,:,1);
% L = zeros(size(l,1),size(l,2));
% 
% for i=1:size(l,1)
%    for j=1:size(l,2)
%       if(l(i,j)>0.8 && l(i,j)<0.87)
%           L(i,j) = 1;
%       end
%    end
% end
% 
% figure();
% subplot(2,1,1);
% imshow(l);
% subplot(2,1,2);
% imshow(L);

% method 2:use rgb to detect pink
LL = zeros(size(image,1),size(image,2));
for i=1:size(image,1)
   for j=1:size(image,2)
       off_count = abs(image(i,j,1)-238)+abs(image(i,j,2)-130)...
                    +abs(image(i,j,3)-238);
       if(off_count <= 10)
          LL(i,j) =1; 
       end
   end
end
figure();
subplot(2,1,1);
imshow(image);
subplot(2,1,2);
imshow(LL);