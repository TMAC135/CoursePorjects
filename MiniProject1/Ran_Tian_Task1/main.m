
%% pseudo code 
clear all;
close all;
clc;
% Read the image to matrix - I
I_total = zeros(480,640,3,291);
cd('img');
for i = 1:291
    if (i < 10)
        filename = ['000',num2str(i),'.jpg'];
    elseif (i < 100)
        filename = ['00',num2str(i),'.jpg'];
    else
        filename = ['0',num2str(i),'.jpg'];
    end
    I_total(:,:,:,i) = imread(filename);
end
cd ..;

% the particle number
num_part = 300;


%initilization for the paricles
particles = zeros(4,num_part);
particles(1:2,:) = 200*ones(2,num_part);%suppose the initial position is 200,200

%initilization for the video
Video = VideoWriter('Ran_Tian Coke video.avi');
open(Video);

%initilization for likelihood,prior and posterior 
%prior = (1/num_part)*ones(1,num_part);
likelihood = zeros(1,num_part);
%posterior = zeros(1,num_part);

for i=1:291
    
    %1:correction step
    I_after = pinklikelihood(I_total(:,:,:,i));
    
    part_pos = particles(1:2,:);% propagate the position probability
    for j=1:num_part
       pos = part_pos(:,j);
       likelihood(j) = I_after(pos(1),pos(2));
%        posterior(j) = likelihood(j)*prior(j);
%        posterior(j) = likelihood(j);
    end
    
    %normalize the probability
%     total = sum(posterior);
    total = sum(likelihood);
    for ii=1:num_part
%        posterior(ii) = posterior(ii)/total;
         likelihood(ii) =likelihood(ii)/total;
    end
    
    debug1=1;
%     prior = posterior; % set the prior for the next iteration
    
    %2:prediction step
    
    %update the particles based on the linear model
    for j=1:num_part
       particles(:,j) = linear_model(particles(:,j));      
    end

    %resampling,update the particles based on the posterior probability
    particles(1:2,:)  = resampling(particles(1:2,:),likelihood);    
    debug2=1;

    %plot the estiation for the current iteration
    plotstep(particles, I_total(:,:,:,i), likelihood,i, 30);
    fig = figure(1);
    f = getframe(fig);
    writeVideo(Video,f);
end

close(Video);