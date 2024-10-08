<?php
namespace App\EventSubscriber;

use App\Repository\SectionRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

class GlobalVariableSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $sectionRepository;

    public function __construct(Environment $twig, SectionRepository $sectionRepository)
    {
        $this->twig = $twig;
        $this->sectionRepository = $sectionRepository;
    }

    private function coucouController(array $controller, Request $request): bool{
        if(get_class($controller[0]) !== "App\\Controller\\CoucouController") return false;
        $sections = $this->sectionRepository->findAll();
        $this->twig->addGlobal('sections', $sections);
        return true;
    }

    private function securityController(array $controller, Request $request): bool{
        if(get_class($controller[0]) !== "App\\Controller\\SecurityController") return false;
        $route_name = $request->attributes->get('_route');
        if($route_name !== "app_login") return false;
        $sections = $this->sectionRepository->findAll();
        $this->twig->addGlobal('sections', $sections);
        return true;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();
        if(is_array($controller)){
            $request = $event->getRequest();
            if($this->coucouController($controller, $request)) return;
            elseif($this->securityController($controller, $request)) return;
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
