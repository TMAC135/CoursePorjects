For this assignment, there is only one main script called main.m, this 
main script contains 3 sections corresponding to the task. Run each section
individually when you test my code in main.m.


Here are some descriptions for self-written functions for each section.For 
detailed descriptions, see comments on each file.

SECTION 1:Histogram and  Thresholding

--smooth_histogram.m: get the histogram array from grey image

--threshold.m : get the threshold value and return the binary image

--find_statistic.m: find the statistic of the histogram array.

SECTION 2:Region Extraction

-- raster_scan.m: implement the raster scan method to label the region

-- plot_regions.m: plot the labeled image in different colors, here I only 
assign 7 colors for 7 regions since I know there are 7 regions before hand.

-- union_labels.m: union the two sets in union set

-- refine_labels.m: refine the connected regions based on a threshold value.The threshold value is set manually.

SECTION 3:Blob statistics

--blob_statistic.m: calculate blob statistics based on the union set and 
labeled image.
