%% Section 1: histogram and thresholding
clear all;
close all;
img3 = imread('reg3.jpg');
img4 = imread('reg4.jpg');
[row,col] = size(img3);

% show the histogram for intensity vs frequency
% figure(), imhist(img3);
% figure(), imhist(img4);

% These are build in functions
% BW3 = roicolor(img3, 90, 255); 
% BW4 = roicolor(img4, 90, 255); 
% figure(), imshow(BW3);
% figure(), imshow(BW4);

%These are thresholding strategy designed by myself
img3_histogram = smooth_histogram(img3);
img4_histogram = smooth_histogram(img4);

%plot the histograms for each image
figure(),
bar(img3_histogram);
title('histogram of the image 3 after smoothing');
figure(),
bar(img4_histogram);
title('histogram of the image 4 after smoothing');

% plot the binary images after thresholding
[binary_image3 thresh3] = threshold(img3,img3_histogram);
[binary_image4 thresh4] = threshold(img4,img4_histogram);
figure(), imshow(binary_image3);
title('image 3 after thresholding');
figure(), imshow(binary_image4);
title('image 4 after thresholding');
% show the thresholdin values in the console for image 3 and 4
thresh3
thresh4

%% Section 2: Extract region -- simple raster scan with union find set
% Here I use the dictionary to implement the set
clf;
union_set3 = containers.Map;
union_set4 = containers.Map;

labels_img3 = raster_scan(union_set3,binary_image3);
labels_img4 = raster_scan(union_set4,binary_image4);

% Refine the labels and eliminate those labels who has less elements
%for image 3
labels_img3 = refine_labels(union_set3,labels_img3,150);

% for image 4
labels_img4 = refine_labels(union_set4,labels_img4,150);

% show the different labels in different colors
image_region3 = 255*ones(row,col,3);%background color is white
image_region4 = 255*ones(row,col,3);
figure(),
plot_regions(union_set3,image_region3);
title('image 3 after region extraction');
figure(),
plot_regions(union_set4,image_region4);
title('image 4 after region extraction');

%% Section 3: calculate the Blob statistics for each region
clf;
[MBR3 centroid3 areas3 holes3 holes_areas3 perimeter3 elongation3] = ...
            blob_statistic(union_set3,labels_img3);
[MBR4 centroid4 areas4 holes4 holes_areas4 perimeter4 elongation4] = ...
            blob_statistic(union_set4,labels_img4);
% show in the console        
holes_areas3
holes_areas4
perimeter3
perimeter4
%Notice: I collect all the data to a table listed in my report for easy of
%reviewing!



