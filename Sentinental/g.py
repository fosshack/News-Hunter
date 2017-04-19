import newspaper

cnn_paper = newspaper.build('http://indianexpress.com/section')

for article in cnn_paper.articles:
	article.url

for category in cnn_paper.category_urls():     
	category

article = cnn_paper.articles[0]
article.download()

article.html

article.parse()


article.text


article.top_image



article.nlp()

print(article.keywords)
