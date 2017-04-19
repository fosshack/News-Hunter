import sys
from tweepy.auth import OAuthHandler
from textblob import TextBlob

# Step 1 - Authenticate
consumer_key= 'OpFbbjqby5JJGOo2m28p7HUKb'
consumer_secret= 'qtjkzCcFMFgPf9TxCvdBIZ1bw1taU7T5ixz5Ik5XHikci8ajfD'

access_token='2907896630-WQCOI1uOJ4xeBHuwIuqjl0i2RiyghO4UpYH95Jv'
access_token_secret='GVAdUU6pJUQNtigZkmJIxjuyP2z9QYeutEOcEYZFN36g3'

auth = tweepy.OAuthHandler(consumer_key, consumer_secret)
auth.set_access_token(access_token, access_token_secret)

api = tweepy.API(auth)

#Step 3 - Retrieve Tweets
public_tweets = api.search('ccn')



#CHALLENGE - Instead of printing out each tweet, save each Tweet to a CSV file
#and label each one as either 'positive' or 'negative', depending on the sentiment 
#You can decide the sentiment polarity threshold yourself

i=s=p=0;

for tweet in public_tweets:
    print(tweet.text)
    
    #Step 4 Perform Sentiment Analysis on Tweets
    analysis = TextBlob(tweet.text)
    p+=analysis.sentiment.polarity
    s+=analysis.sentiment.subjectivity
    print(analysis.sentiment)   
    print("")
    i+=1
p/=i
s/=i
print("AVG POLARITY = ")
print(p)
print("AVG SUBJECTIVITY = ")
print(s)
