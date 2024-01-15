<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex(): string
    {
        $array = [
            [rand(0, 1), rand(0, 1), rand(0, 1), rand(0, 1), rand(0, 1)],
            [rand(0, 1), rand(0, 1), rand(0, 1), rand(0, 1), rand(0, 1)],
            [rand(0, 1), rand(0, 1), rand(0, 1), rand(0, 1), rand(0, 1)],
            [rand(0, 1), rand(0, 1), rand(0, 1), rand(0, 1), rand(0, 1)],
            [rand(0, 1), rand(0, 1), rand(0, 1), rand(0, 1), rand(0, 1)],
        ];

        $count = 0;
        foreach ($array as $i => $row) {
            foreach ($row as $j => $value) {
                if ($value !== 0) {
                    continue;
                }
                $localCount = 0;

                if (isset($array[$i - 1][$j]) && $array[$i - 1][$j] === 1) {
                    $localCount++;
                }
                if (isset($array[$i + 1][$j]) && $array[$i + 1][$j] === 1) {
                    $localCount++;
                }
                if (isset($row[$j - 1]) && $row[$j - 1] === 1) {
                    $localCount++;
                }
                if (isset($row[$j + 1]) && $row[$j + 1] === 1) {
                    $localCount++;
                }

                if ($localCount > 2) {
                    $count = $count + 1;
                }
            }
        }


        return $this->render('index', ['array' => $array, 'count' => $count]);
    }
}
