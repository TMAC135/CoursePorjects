For this programming assignment, there are mainly 2 running scripts
-roberts.m
-sobel.m
which correspond to edge detection operators, the main contend of these two scripts are 
the same except for the kernel matrix. The structure of two scripts are formed of two parts:
part 1 is for step 1 and step 2 in the assignment, part 2 is for step 3.

There are other instrumental function scripts for this assignment which are written by me:
-conv2() => compute the convolution of two matrix, which perform the same functionality as build-in function conv2() 
-neighbor_count() => count number of 255’s for a given element in a matrix, using 8 connectivity
-expension() => fill in the gap for the magnitude from part 1
-thining() => do edge thinning after expansion matrix, we use eight connectivity and have 4 passes for the original matrix

Two images are choose from web, the reference  are 
test image 4 is from https://whatsinabrain.wordpress.com/2013/07/05/imagining-an-apple-vs-a-banana/
test image 5 is from http://www.dreamstime.com/stock-photos-basketball-football-balls-image3220413