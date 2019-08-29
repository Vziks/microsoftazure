#### Configuration

Add to config/services.yaml
```
App\MicrosoftAzure\Service\CognitiveTextAnalyticService:
    public: false
    arguments: ['@App\MicrosoftAzure\MicrosoftAzureApiHandler']

app.service.cognitive_text_analytic:
    alias: App\MicrosoftAzure\Service\CognitiveTextAnalyticService
    public: true

App\MicrosoftAzure\MicrosoftAzureApiHandler:
    public: true
    tags:
        - { name: monolog.logger, channel: msa }
```            
Add to config/packages/<ENV>/monolog.yaml
```
handlers:
    msa:
        type: rotating_file
        path: "%kernel.logs_dir%/%kernel.environment%-msa.log"
        level: debug
        channels: ["msa"]
```            
   
Add to .ENV
```
MSA_ADWTA_KEY="access key"
MSA_ADWTA_URL="azure cognitiveservices url"
```        
### Usage
```
Inject to method 
public function checkAction(CognitiveTextAnalyticService $cognitiveTextAnalyticService)

$instagramComments = $em->getRepository(InstagramComment::class)->findBy([], [], 10);
$result = $cognitiveTextAnalyticService->getSentimentText($instagramComments);
                     
or 

$result = $this->get('app.service.cognitive_text_analytic')->getSentimentText($instagramComments);
```

  