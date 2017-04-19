import sys
from textblob import TextBlob
import newspaper
import nltk
from nltk.tokenize import PunktSentenceTokenizer


cnn_paper = newspaper.build('http://indianexpress.com')

for article in cnn_paper.articles:
	print(article.url)
for category in cnn_paper.category_urls():     
	print(category)

article = cnn_paper.articles[0]
article.download()
article.html
article.parse()
article.text
article.top_image
article.nlp()
sample=article.keywords

for i in sample:
	words=nltk.word_tokenize(i)
	tagged=nltk.pos_tag(words)
	if(tagged[0][1]=='NN'):
    	a=tagged[0][0]
    	print(a)
    else:
    	continue
   
    


    
    
   