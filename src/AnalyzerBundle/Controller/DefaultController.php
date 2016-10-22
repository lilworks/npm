<?php

namespace AnalyzerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AnalyzerBundle\Filter\DescriptorTreeFilter;

class DefaultController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $lastBreakdowns = $em->getRepository('AppBundle:Breakdown')->findLast(10);
        $breakdowns = $em->getRepository('AppBundle:Breakdown')->findAll();
        return $this->render('AnalyzerBundle:Default:index.html.twig',
            array(
                "lastBreakdowns"=>$lastBreakdowns,
                "breakdowns"=>$breakdowns
            )
        );
    }

    public function menuAction()
    {
        return $this->render('AnalyzerBundle:Default:menu.html.twig');
    }

    public function descriptorBarAction(Request $request)
    {
        $form = $this->get('form.factory')->create(DescriptorTreeFilter::class);
        $nodes = $edges = $descriptors  = null;
        $breakdowns = array();
        if ($request->query->has($form->getName())) {
            $form->submit($request->query->get($form->getName()));
            $data = $form->getData();
            $edges = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Descriptor')
                ->AnalyzerEdges2($data["category"],$data["start"],$data["stop"],$data["minDuration"],$data["maxDuration"]);
            $nodes = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Descriptor')
                ->AnalyzerNodes2($data["category"],$data["start"],$data["stop"],$data["minDuration"],$data["maxDuration"]);
            foreach($nodes as $node){
                foreach( explode(',',$node["breakdownsField"]) as $breakdown ){
                    if(!in_array($breakdown,$breakdowns)){
                        array_push($breakdowns,$breakdown);
                    }
                }
            }
            $nodes = json_encode($nodes);
            $edges = json_encode($edges);
            $descriptors = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Descriptor')
                ->AnalyzerFindAll2($data["category"],$data["start"],$data["stop"],$data["minDuration"],$data["maxDuration"]);
            foreach($descriptors as $descriptor){
                foreach( explode(',',$descriptor["breakdownsList"]) as $breakdown ){
                    if(!in_array($breakdown,$breakdowns)){
                        array_push($breakdowns,$breakdown);
                    }
                }
            }
            $descriptors = json_encode($descriptors);
        }

        return $this->render('AnalyzerBundle:Default:descriptorBar2.html.twig',
            array(
                'breakdowns'=>$breakdowns,
                'descriptors'=>$descriptors,
                'nodes'=>$nodes,
                'edges'=>$edges,
                'form' => $form->createView()
            )
        );

    }
    public function descriptorTreeAction(Request $request)
    {
        $form = $this->get('form.factory')->create(DescriptorTreeFilter::class);

        $nodes = $edges = null;
        $breakdowns = array();

        if ($request->query->has($form->getName())) {

            $form->submit($request->query->get($form->getName()));

            $data = $form->getData();


            $edges = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Descriptor')
                ->AnalyzerEdges2($data["category"],$data["start"],$data["stop"],$data["minDuration"],$data["maxDuration"]);
            $nodes = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Descriptor')
                ->AnalyzerNodes2($data["category"],$data["start"],$data["stop"],$data["minDuration"],$data["maxDuration"]);

            foreach($nodes as $node){
                foreach( explode(',',$node["breakdownsField"]) as $breakdown ){
                    if(!in_array($breakdown,$breakdowns)){
                        array_push($breakdowns,$breakdown);
                    }
                }
            }
            $nodes = json_encode($nodes);
            $edges = json_encode($edges);
        }

        return $this->render('AnalyzerBundle:Default:descriptorTree.html.twig',
            array(
                'breakdowns'=>$breakdowns,
                'nodes'=>$nodes,
                'edges'=>$edges,
                'form' => $form->createView()
            )
        );
    }
    public function breakdownTimelineAction()
    {
        return $this->render('AnalyzerBundle:Default:breakdownTimeline.html.twig');
    }
}
