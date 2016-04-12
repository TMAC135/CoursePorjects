function L = pinklikelihood(I)
% Extracts a likelihood of the amount of "redness" in pixels
%   in the imput image I.  Uses a heuristic!
%
% Input:
%    I -- current observations (image in 3-panel RGB format with entries
%         ranging from 0 to 255)
% Output:
%    L -- a matrix having the same dimensions as I (in the first 2 
%         coordinates) that contains a non-negative value proportional
%         to the likelihood value for each corresponding coordinate 
%         of the image I
%
% Ran Tian
% University of Minnesota
% EE 8581 Spring 2016

% Specify a "blob" (to be used in the likelihood model below...)
[xx,yy] = meshgrid(-50:1:50,-50:1:50);
blob = exp(-(1e-2)*(xx.^2 + yy.^2));

% Get the likelihood
Idouble = double(I); % Cast as a double-precision
L = zeros(size(I,1),size(I,2));

% method1:RGB,which is not working good 
% check the color map for the pink color, it's R:255, G:0, B:255 
% for i=1:size(I,1)
%    for j=1:size(I,2)
%        off_count = abs(Idouble(i,j,1)-255)+abs(Idouble(i,j,2)-0)...
%                     +abs(Idouble(i,j,3)-255);
% %        if(off_count == 0)
% %           L(i,j) = 1;%set the value to 1
% %        else
% %            L(i,j) = 10/off_count;
% %        end
%         if(off_count <= 20)
%            L(i,j) = 1; 
%         end
%         
%    end
% end

% method2: HSV, I only use H matrix which represent for the color,which is
% much better
hsv = rgb2hsv(Idouble);
h_matrix=hsv(:,:,1);

for i=1:size(h_matrix,1)
   for j=1:size(h_matrix,2)
      if(h_matrix(i,j)>0.8 && h_matrix(i,j)<0.9)%range~(0.8,0.9) is in pink
          L(i,j) = 1;
      end
   end
end

% L = L.*(L>0); % keep just the non-negative values
% if (max(max(L))==0); L = 1; end  % in case no "redness"
% L = L./max(max(L)); % rescale
L = L + 0.001; % add a small offset to each
L = filter2(blob,L); % then filter by the "blob"